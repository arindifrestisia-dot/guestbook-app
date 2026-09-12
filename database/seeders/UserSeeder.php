<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Galih Aleanda',
            'username' => 'aleanda',
            'email' => 'aleanda@gmail.com',
            'password' => Hash::make('aleanda123'),
            'position' => 'Relations Officer',
            'photo' => 'images/download.jfif',
            'role' => '1',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Ratih Maharani',
            'username' => 'maharani',
            'email' => 'maharani@gmail.com',
            'password' => Hash::make('maharani123'),
            'position' => 'Relations Officer',
            'photo' => 'images/download.jfif',
            'role' => '0',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
