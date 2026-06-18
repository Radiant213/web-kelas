<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update Admin
        $admin = User::where('username', 'admin_kelas')->first();
        if ($admin) {
            $admin->password = Hash::make('admin1234');
            $admin->save();
            $this->command->info('Password admin_kelas berhasil di-update!');
        }

        // Update Siswa Galang
        $siswa = User::where('username', '21676')->first();
        if ($siswa) {
            $siswa->password = Hash::make('Galang123');
            $siswa->save();
            $this->command->info('Password siswa 21676 berhasil di-update!');
        }
    }
}
