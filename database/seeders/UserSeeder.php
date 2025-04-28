<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin SMK',
            'email' => 'admin@smkth.com',
            'password' => Hash::make('password'), // ganti password ini kalau mau
            'role' => 'admin',
        ]);

        // Bendahara
        User::create([
            'name' => 'Bendahara Sekolah',
            'email' => 'bendahara@smkth.com',
            'password' => Hash::make('password'), // ganti password ini kalau mau
            'role' => 'bendahara',
        ]);

        // Kepala Sekolah
        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@smkth.com',
            'password' => Hash::make('password'), // ganti password ini kalau mau
            'role' => 'kepala_sekolah',
        ]);
    }
}
