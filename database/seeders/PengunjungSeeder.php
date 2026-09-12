<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengunjungs')->insert([
            'name' => 'Riski Wijaya',
            'telepon' => '085745675676',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Pria',
            'alamat' => 'Jl. Mawar',
            'pekerjaan' => 'Mahasiswa',
            'keperluan' => 'Kerjasama',
            'bertemu' => 'Pk Anti',
            'photo' => '',
            'skor_kepuasan' => 5,
            'komentar_kepuasan' => 'Terima kasih atas pelayanannya',
            'created_at' => Carbon::parse('2024-09-29 14:30:00'),
            'updated_at' => Carbon::parse('2024-09-29 14:30:00'),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Andi Setiawan',
            'telepon' => '081234567890',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Pria',
            'alamat' => 'Jl. Melati',
            'pekerjaan' => 'Pegawai Swasta',
            'keperluan' => 'Interview',
            'bertemu' => 'Bu Sari',
            'photo' => '',
            'skor_kepuasan' => 4,
            'komentar_kepuasan' => 'Pelayanan memuaskan',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Siti Nurhaliza',
            'telepon' => '081345678912',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Wanita',
            'alamat' => 'Jl. Anggrek',
            'pekerjaan' => 'Pegawai Negeri',
            'keperluan' => 'Konsultasi',
            'bertemu' => 'Pak Budi',
            'photo' => '',
            'skor_kepuasan' => 3,
            'komentar_kepuasan' => 'Pelayanan cukup baik',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Dewi Anggraeni',
            'telepon' => '085657890123',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Wanita',
            'alamat' => 'Jl. Kenanga',
            'pekerjaan' => 'Ibu Rumah Tangga',
            'keperluan' => 'Acara Keluarga',
            'bertemu' => 'Bu Sari',
            'photo' => '',
            'skor_kepuasan' => 5,
            'komentar_kepuasan' => 'Sangat puas dengan pelayanannya',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Budi Santoso',
            'telepon' => '081290123456',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Pria',
            'alamat' => 'Jl. Jambu',
            'pekerjaan' => 'PNS',
            'keperluan' => 'Rapat',
            'bertemu' => 'Pak Budi',
            'photo' => '',
            'skor_kepuasan' => 4,
            'komentar_kepuasan' => 'Layanan sangat baik',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Wahyudi Ananta',
            'telepon' => '081298765432',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Pria',
            'alamat' => 'Jl. Sakura',
            'pekerjaan' => 'Freelancer',
            'keperluan' => 'Kerjasama Proyek',
            'bertemu' => 'Pak Andi',
            'photo' => '',
            'skor_kepuasan' => 5,
            'komentar_kepuasan' => 'Sangat baik dan responsif',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Rina Kartika',
            'telepon' => '081234561234',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Wanita',
            'alamat' => 'Jl. Flamboyan',
            'pekerjaan' => 'Pengusaha',
            'keperluan' => 'Pembelian Barang',
            'bertemu' => 'Bu Sari',
            'photo' => '',
            'skor_kepuasan' => 5,
            'komentar_kepuasan' => 'Proses pembelian cepat',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Irwan Saputra',
            'telepon' => '082123456789',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Pria',
            'alamat' => 'Jl. Merpati',
            'pekerjaan' => 'Dosen',
            'keperluan' => 'Seminar',
            'bertemu' => 'Pak Ali',
            'photo' => '',
            'skor_kepuasan' => 4,
            'komentar_kepuasan' => 'Seminar berlangsung lancar',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Maya Sari',
            'telepon' => '085123498765',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Wanita',
            'alamat' => 'Jl. Cemara',
            'pekerjaan' => 'Guru',
            'keperluan' => 'Pendidikan',
            'bertemu' => 'Bu Tina',
            'photo' => '',
            'skor_kepuasan' => 4,
            'komentar_kepuasan' => 'Informasi sangat membantu',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);

        DB::table('pengunjungs')->insert([
            'name' => 'Feri Setiawan',
            'telepon' => '081234512345',
            'instansi' => 'Politeknik Caltex Riau',
            'gender' => 'Pria',
            'alamat' => 'Jl. Durian',
            'pekerjaan' => 'Pengusaha',
            'keperluan' => 'Investasi',
            'bertemu' => 'Pak Rudi',
            'photo' => '',
            'skor_kepuasan' => 5,
            'komentar_kepuasan' => 'Investasi berjalan lancar',
            'created_at' => Carbon::now()->subDays(rand(0, 90)),
            'updated_at' => Carbon::now()->subDays(rand(0, 90)),
        ]);
    }
}
