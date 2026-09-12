<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    // Tentukan field yang dapat diisi (mass assignable)
    protected $fillable = [
        'name',
        'telepon',
        'instansi',
        'gender',
        'alamat',
        'pekerjaan',
        'keperluan',
        'bertemu',
        'tanggal',
        'photo',
        'skor_kepuasan',
        'komentar_kepuasan',
    ];
}
