<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['name' => "AFRIZA NUR 'AINI", 'nis' => '21660', 'password' => 'afriza123'],
            ['name' => "AHMAD SYIHABULLAIL FAKHRULLAH", 'nis' => '21661', 'password' => 'ahmad123'],
            ['name' => "ALDO AL GHIFARY TANAKA", 'nis' => '21662', 'password' => 'aldo123'],
            ['name' => "AMANDA SALSABILA PUTRI", 'nis' => '21663', 'password' => 'amanda123'],
            ['name' => "ATIKA ATHAILLAH", 'nis' => '21664', 'password' => 'atika123'],
            ['name' => "AURA ECHANUR AURIGA", 'nis' => '21665', 'password' => 'aura123'],
            ['name' => "AWWALU ZAKHARY WARADANA", 'nis' => '21666', 'password' => 'awwalu123'],
            ['name' => "AZIZ SYARIF PUTRA QURNIA", 'nis' => '21667', 'password' => 'aziz123'],
            ['name' => "CHRISTIAN DAVE SURYA PERMANA", 'nis' => '21668', 'password' => 'christian123'],
            ['name' => "DANENDRA FATHAN ASMARA", 'nis' => '21669', 'password' => 'danendra123'],
            ['name' => "DINI DWI AULIA", 'nis' => '21670', 'password' => 'dini123'],
            ['name' => "EVAN ZAKI PRATAMA", 'nis' => '21671', 'password' => 'evan123'],
            ['name' => "EZZAR SINGGIH PRATAMA", 'nis' => '21672', 'password' => 'ezzar123'],
            ['name' => "FAHRI AZZAM MANDRIVA", 'nis' => '21673', 'password' => 'fahri123'],
            ['name' => "FAUZAN IKA NUR RIANTO", 'nis' => '21674', 'password' => 'fauzan123'],
            ['name' => "FIONA ADETHA PUTRI", 'nis' => '21675', 'password' => 'fiona123'],
            ['name' => "GALANG MA'RUF SHERINIAN", 'nis' => '21676', 'password' => 'galang123'],
            ['name' => "KIARA ANINDITA", 'nis' => '21677', 'password' => 'kiara123'],
            ['name' => "LAILATUL QONA'AH", 'nis' => '21678', 'password' => 'lailatul123'],
            ['name' => "LUTFIATUZ ZAHWA AROFAH", 'nis' => '21679', 'password' => 'lutfiatuz123'],
            ['name' => "MAVIS HARYO PRATAMA", 'nis' => '21680', 'password' => 'mavis123'],
            ['name' => "MIKAIL ZABIR WIDODO", 'nis' => '21681', 'password' => 'mikail123'],
            ['name' => "MUHAMMAD IQBAL WIDODO", 'nis' => '21682', 'password' => 'muhammad123'],
            ['name' => "NAHDA PRANAJA NADHIF KHAIRULLAH", 'nis' => '21683', 'password' => 'nahda123'],
            ['name' => "NAMIRA NOOR HISYANA", 'nis' => '21684', 'password' => 'namira123'],
            ['name' => "NARENDRA ADI WIBOWO", 'nis' => '21685', 'password' => 'narendra123'],
            ['name' => "NASYWA TSAQIB OXYANA HUWAIDAA", 'nis' => '21686', 'password' => 'nasywa123'],
            ['name' => "RESTU EZZAR RADITYA", 'nis' => '21687', 'password' => 'restu123'],
            ['name' => "REVA NAGALI ANINGTYAS", 'nis' => '21688', 'password' => 'reva123'],
            ['name' => "RIFA AIDHIL PRASETIYO", 'nis' => '21689', 'password' => 'rifa123'],
            ['name' => "RISQI ARIF SOLEHAN", 'nis' => '21690', 'password' => 'risqi123'],
            ['name' => "RIZKY WAHYU PRATAMA", 'nis' => '21691', 'password' => 'rizky123'],
            ['name' => "SEKARWANGI PUTRI", 'nis' => '21692', 'password' => 'sekar123'],
            ['name' => "SELVI INDRIANI", 'nis' => '21693', 'password' => 'selvi123'],
            ['name' => "SHAEMA SYIARA TAUHID ISLAMADAVI", 'nis' => '21694', 'password' => 'shaema123'],
            ['name' => "ZED HANIIN WAAFI EL HAQ", 'nis' => '21695', 'password' => 'zed123'],
        ];

        foreach ($students as $studentData) {
            // 1. Create or Update User
            $user = User::updateOrCreate(
                ['username' => $studentData['nis']], // Search by NIS (username)
                [
                    'password' => Hash::make($studentData['password']),
                    'role' => 'student',
                ]
            );

            // 2. Create or Update Student Profile
            Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'username' => $user->username,
                    'full_name' => $studentData['name'],
                    'place_of_birth' => '-', // Dummy data
                    'date_of_birth' => '2008-01-01', // Dummy data
                    'origin_school' => '-', // Dummy data
                    'address' => '-', // Dummy data
                    'child_number' => 1, // Dummy data
                    'is_completed' => false,
                ]
            );
        }

        $this->command->info('36 Akun Siswa berhasil dibuat/diupdate!');
    }
}
