<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use App\Models\Pengunjung;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch recent activities
        $user = Auth::user();
        $recent = Activity::causedBy($user)
            ->latest()
            ->take(5) // Number of activities to fetch
            ->get();

        $activities = Activity::orderBy('created_at', 'desc')->take(10)->get();

        // Ambil seluruh total users
        // Fetch total users
        $totalUsers = User::count();


        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Get average rating per week for the current month
        $averageRatings = DB::table('pengunjungs')
            ->select(DB::raw('WEEK(created_at) as week, AVG(skor_kepuasan) as average_rating'))
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->whereNotNull('skor_kepuasan')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Fetch gender distribution
        $genderDistribution = DB::table('pengunjungs')
            ->select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get()
            ->pluck('total', 'gender');

        // Prepare the data for view
        $maleCount = $genderDistribution->get('Pria', 0);
        $femaleCount = $genderDistribution->get('Wanita', 0);

        // Get guest visits per week for the current month
        $weeklyGuestCount = DB::table('pengunjungs')
            ->select(DB::raw('WEEK(created_at) as week, COUNT(*) as guest_count'))
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Create a guest count array for each week
        $guestCounts = [0, 0, 0, 0]; // Initialize with zeroes for 4 weeks

        foreach ($weeklyGuestCount as $data) {
            // Map the guest counts to the respective weeks (assuming week numbers start from 1 for simplicity)
            $weekIndex = $data->week - date('W', strtotime("first day of $currentMonth $currentYear")) + 1; // Map week number to 0-3 index
            if ($weekIndex >= 0 && $weekIndex < 4) {
                $guestCounts[$weekIndex] = $data->guest_count;
            }
        }

        // Total Pengunjung Bulan Ini
        // Total guest count for the current month
        $guestCount = Pengunjung::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();


        // Rating Ulasan Pelanggan Bulan Sekarang
        // Fetch skor_kepuasan for the current month, excluding null values
        $ratings = DB::table('pengunjungs')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->whereNotNull('skor_kepuasan')
            ->pluck('skor_kepuasan');

        // Calculate the average rating, round it to one decimal place
        $averageRating = $ratings->avg();
        $averageRating = round($averageRating, 1); // Example: 4.2





        //Chart 1
        // Fetching the number of guests per month
        $monthlyGuests = Pengunjung::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc') // Urutkan dari tahun terlama ke terbaru
            ->orderBy('month', 'asc') // Urutkan dari bulan terlama ke terbaru
            ->get();

        // Prepare data for chart
        $data = [
            'labels' => $monthlyGuests->map(function ($item) {
                return Carbon::create($item->year, $item->month, 1)->format('F Y'); // Contoh: "September 2023"
            })->toArray(),
            'values' => $monthlyGuests->map(function ($item) {
                return $item->count;
            })->toArray()
        ];

        // Calculate average visitor satisfaction per month
        $averageSatisfactionScores = DB::table('pengunjungs')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('AVG(skor_kepuasan) as average_score'))
            ->whereNotNull('skor_kepuasan')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        
            $keperluan = [
                'Konsultasi Informasi Teknologi',
                'Kunjungan Edukasi',
                'Layanan Pengujian Penerapan Standar/Laboratorium',
                'Layanan Magang & PKL',
                'Layanan Benih/Bibit',
                'Kerjasama',
                'Mengantar Surat/Undangan'
            ];
            
            $dataKeperluan = [];
            
            // Hitung jumlah berdasarkan setiap tujuan dalam $keperluan
            foreach ($keperluan as $tujuan) {
                $jumlah = DB::table('pengunjungs')
                    ->where('keperluan', $tujuan)
                    ->whereYear('created_at', $currentYear)
                    ->count();
                $dataKeperluan[$tujuan] = $jumlah;
            }
            
            // Hitung jumlah untuk kategori "Lainnya"
            $jumlahLainnya = DB::table('pengunjungs')
                ->whereNotIn('keperluan', $keperluan) // Semua yang tidak ada di $keperluan
                ->whereYear('created_at', $currentYear)
                ->count();
            $dataKeperluan['Lainnya'] = $jumlahLainnya;
            
            $ageData = DB::table('pengunjungs')
    ->select(DB::raw('umur, COUNT(*) as count'))
    ->groupBy('umur')
    ->orderBy('umur')
    ->pluck('count', 'umur');

            return view('after-login.dashboard.index', compact(
                'recent',
                'activities',
                'totalUsers',
                'weeklyGuestCount',
                'guestCount',
                'guestCounts',
                'maleCount',
                'femaleCount',
                'data',
                'averageRatings',
                'averageRating',
                'averageSatisfactionScores',
                'dataKeperluan' ,
                'ageData'
            ));
        }            
}
