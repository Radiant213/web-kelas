<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Akun Admin (Ketua Kelas/Lu)
        User::create([
            'username' => 'admin_kelas', // Login pake ini
            'password' => Hash::make('rahasia123'), // Password di-hash otomatis
            'role' => 'admin',
        ]);

        // 2. Akun Siswa Dummy Pertama
        User::create([
            'username' => '21676', // NIS atau Nomor Absen
            'password' => Hash::make('passworddefault'), // Password default buat siswa
            'role' => 'student',
        ]);

        // Lu bisa buat loop di sini buat 36 siswa otomatis (Nanti kita bahas kalau lu mau)
    }
}