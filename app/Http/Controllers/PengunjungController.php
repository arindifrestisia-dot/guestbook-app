<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class PengunjungController extends Controller
{
    public function index()
    {
        $pengunjungs = Pengunjung::orderBy('created_at', 'desc')->paginate(4);

        // Mengubah format created_at untuk setiap pengunjung
        foreach ($pengunjungs as $pengunjung) {
            $pengunjung->formatted_created_at = Carbon::parse($pengunjung->created_at)->format('d-m-Y H:i:s');
        }

        $title = 'Hapus Data Pengunjung!';
        $text = 'Apakah Anda yakin ingin menghapus pengunjung ini?';
        confirmDelete($title, $text);

        // Tampilkan view dan kirimkan data pengunjung ke view
        return view('after-login.pengunjung.index', compact('pengunjungs'));

    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|max:255',
            'umur' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'instansi' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'alamat' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'custom_keperluan' => 'nullable|required_if:keperluan,other|string|max:255',
            'bertemu' => 'required|string|max:255',
            'photo' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            // Dapatkan semua pesan error dari validator
            $messages = $validator->errors()->messages();

            // Cek apakah ada error pada masing-masing field dan tampilkan SweetAlert
            if (isset($messages['name'])) {
                Alert::error('Gagal!', 'Nama tidak boleh kosong.');
            } elseif (isset($messages['umur'])) {
                Alert::error('Gagal!', 'Umur tidak boleh kosong.');
            } elseif (isset($messages['telepon'])) {
                Alert::error('Gagal!', 'Telepon tidak boleh kosong.');
            } elseif (isset($messages['instansi'])) {
                Alert::error('Gagal!', 'Instansi tidak boleh kosong.');
            } elseif (isset($messages['gender'])) {
                Alert::error('Gagal!', 'Gender tidak boleh kosong.');
            } elseif (isset($messages['alamat'])) {
                Alert::error('Gagal!', 'Alamat tidak boleh kosong.');
            } elseif (isset($messages['pekerjaan'])) {
                Alert::error('Gagal!', 'Pekerjaan tidak boleh kosong.');
            } elseif (isset($messages['keperluan'])) {
                Alert::error('Gagal!', 'Keperluan tidak boleh kosong.');
            } elseif (isset($messages['bertemu'])) {
                Alert::error('Gagal!', 'Bertemu dengan siapa tidak boleh kosong.');
            }

            // Kembali ke halaman sebelumnya dengan input lama dan pesan error
            return back()->withErrors($validator)->withInput();
        }

        $keperluan = $request->keperluan === 'other' ? $request->custom_keperluan : $request->keperluan;
        
        $pengunjung = new Pengunjung;
        $pengunjung->name = $request->name;
        $pengunjung->nik = $request->nik;
        $pengunjung->umur = $request->umur;
        $pengunjung->telepon = $request->telepon;
        $pengunjung->instansi = $request->instansi;
        $pengunjung->gender = $request->gender;
        $pengunjung->alamat = $request->alamat;
        $pengunjung->pekerjaan = $request->pekerjaan;
        $pengunjung->keperluan =$keperluan;
        $pengunjung->bertemu = $request->bertemu;

        // Simpan data ke database
        if ($request->photo) {
            // Dekode base64 menjadi file gambar
            $photoData = $request->photo;
            $fileName = time() . '.png'; // Buat nama file

            // Pisahkan base64 prefix dari data
            list($type, $photoData) = explode(';', $photoData);
            list(, $photoData) = explode(',', $photoData);

            // Dekode base64 menjadi binary data
            $photoData = base64_decode($photoData);

            // Simpan gambar ke direktori public/images
            file_put_contents(public_path('images/' . $fileName), $photoData);

            // Simpan nama file ke dalam database
            $pengunjung->photo = $fileName;
        }

        // Simpan data ke database
        $pengunjung->save();

        activity()
            ->performedOn($pengunjung)
            ->log('Pengunjung ' . $pengunjung->name . ' berhasil ditambahkan');

        // Redirect ke halaman kepuasan dengan ID pengunjung yang baru dibuat
        Alert::success('Sukses!', 'Data Pengunjung Berhasil Ditambahkan!');
        // return redirect()->route('pengunjungs.kepuasan', ['id' => $pengunjung->id]);
        return view('before-login.dashboard-guest');

    }

    public function indexReview()
    {
        // Mengambil data pengunjung dengan akses_kepuasan = 0 dan mengurutkan berdasarkan created_at
        $pengunjungs = Pengunjung::where('akses_kepuasan', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        // Mengubah format created_at untuk setiap pengunjung
        foreach ($pengunjungs as $pengunjung) {
            $pengunjung->formatted_created_at = Carbon::parse($pengunjung->created_at)->format('d-m-Y H:i:s');
        }

        // Mengembalikan data ke view
        return view('before-login.kepuasan-index', compact('pengunjungs'));
    }



    public function kepuasanForm($id)
    {
        // Cari pengunjung berdasarkan ID
        $pengunjung = Pengunjung::findOrFail($id);

        if (!$pengunjung) {
            Alert::error('Gagal!', 'Data Pengunjung tidak ditemukan.');
            return redirect('/');
        }

        // Cek apakah pengunjung sudah mengakses form kepuasan
        if ($pengunjung->akses_kepuasan) {
            Alert::error('Gagal!', 'Anda sudah mengisi formulir kepuasan.');
            return redirect('/');
        }

        // Jika belum diakses, set akses menjadi true dan lanjutkan
        $pengunjung->akses_kepuasan = true;
        $pengunjung->save();

        return view('before-login.kepuasan-pengunjung', compact('pengunjung'));
    }

    public function storeKepuasan(Request $request)
    {
        // Validasi data kepuasan
        $request->validate([
            'skor_kepuasan' => 'nullable|integer|min:1|max:5',
            'komentar_kepuasan' => 'nullable|string',
            'id' => 'required|exists:pengunjungs,id', // Pastikan ID pengunjung ada
        ]);

        // Temukan pengunjung dan simpan nilai kepuasan
        $pengunjung = Pengunjung::findOrFail($request->id);
        $pengunjung->skor_kepuasan = $request->skor_kepuasan;
        $pengunjung->komentar_kepuasan = $request->komentar_kepuasan;
        $pengunjung->save();

        Alert::success('Sukses!', 'Terimakasih atas penilaian anda! ');

        return redirect('/');
    }

    public function exportExcel()
    {
        $pengunjungs = Pengunjung::all(); // Ambil semua data pengunjung

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'NIK');
        $sheet->setCellValue('D1', 'Umur');
        $sheet->setCellValue('E1', 'Phone');
        $sheet->setCellValue('F1', 'Instansi');
        $sheet->setCellValue('G1', 'Gender');
        $sheet->setCellValue('H1', 'Alamat');
        $sheet->setCellValue('I1', 'Pekerjaan');
        $sheet->setCellValue('J1', 'Keperluan');
        $sheet->setCellValue('K1', 'Bertemu');
        $sheet->setCellValue('L1', 'Skor Kepuasan');
        $sheet->setCellValue('M1', 'Komentar Kepuasan');
        $sheet->setCellValue('N1', 'Waktu Kunjungan');


        // Populate data
        $row = 2;
        foreach ($pengunjungs as $pengunjung) {
            $sheet->setCellValue('A' . $row, $pengunjung->id);
            $sheet->setCellValue('B' . $row, $pengunjung->name);
            $sheet->setCellValue('C' . $row, $pengunjung->nik);
            $sheet->setCellValue('D' . $row, $pengunjung->umur);
            $sheet->setCellValue('E' . $row, $pengunjung->telepon);
            $sheet->setCellValue('F' . $row, $pengunjung->instansi);
            $sheet->setCellValue('G' . $row, $pengunjung->gender);
            $sheet->setCellValue('H' . $row, $pengunjung->alamat);
            $sheet->setCellValue('I' . $row, $pengunjung->pekerjaan);
            $sheet->setCellValue('J' . $row, $pengunjung->keperluan);
            $sheet->setCellValue('K' . $row, $pengunjung->bertemu);
            $sheet->setCellValue('L' . $row, $pengunjung->skor_kepuasan);
            $sheet->setCellValue('M' . $row, $pengunjung->komentar_kepuasan);
            $sheet->setCellValue('N' . $row, $pengunjung->created_at);
            $row++;
        }

        // Simpan ke file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'pengunjungs.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    public function destroy($id)
    {
        $pengunjung = Pengunjung::find($id);
        if (!$pengunjung) {
            return redirect()->route('pengunjungs.index')->with('error', 'Pengunjung tidak ditemukan.');
        }

        // Hapus file foto jika ada
        if ($pengunjung->photo) {
            $imagePath = public_path('images/' . $pengunjung->photo);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file foto
            }
        }

        // Hapus data pengunjung berdasarkan id
        $pengunjung->delete();

        activity()
            ->performedOn($pengunjung)
            ->causedBy(Auth::user())
            ->log('Menghapus Data Pengunjung ' . $pengunjung->name);

        Alert::success('Sukses!', 'Data Pengunjung Berhasil Dihapus!');

        // Redirect ke halaman index atau menampilkan notifikasi
        return redirect()->route('pengunjungs.index');
    }

    public function review()
    {
        $pengunjungs = Pengunjung::orderBy('created_at', 'desc')->paginate(8);

        // Mengubah format created_at untuk setiap pengunjung
        foreach ($pengunjungs as $pengunjung) {
            $pengunjung->formatted_created_at = Carbon::parse($pengunjung->created_at)->format('d-m-Y H:i:s');
        }

        // Tampilkan view dan kirimkan data pengunjung ke view
        return view('after-login.pengunjung.review', compact('pengunjungs'));
    }

    public function exportExcelReview()
    {
        $pengunjungs = Pengunjung::all(); // Ambil semua data pengunjung

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Instansi');
        $sheet->setCellValue('D1', 'Skor Kepuasan');
        $sheet->setCellValue('E1', 'Komentar Kepuasan');
        $sheet->setCellValue('F1', 'Waktu Kunjungan');


        // Populate data
        $row = 2;
        foreach ($pengunjungs as $pengunjung) {
            $sheet->setCellValue('A' . $row, $pengunjung->id);
            $sheet->setCellValue('B' . $row, $pengunjung->name);
            $sheet->setCellValue('C' . $row, $pengunjung->instansi);
            $sheet->setCellValue('D' . $row, $pengunjung->skor_kepuasan);
            $sheet->setCellValue('E' . $row, $pengunjung->komentar_kepuasan);
            $sheet->setCellValue('F' . $row, $pengunjung->created_at);
            $row++;
        }

        // Simpan ke file Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'pengunjungs.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $pengunjungs = Pengunjung::where('name', 'like', '%' . $search . '%')
            ->orWhere('instansi', 'like', '%' . $search . '%')
            ->orWhere('komentar_kepuasan', 'like', '%' . $search . '%')
            ->paginate(8);

        return view('after-login.pengunjung.review', compact('pengunjungs'));
    }

}
