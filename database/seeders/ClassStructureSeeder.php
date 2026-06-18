<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassStructure;

class ClassStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $structures = [
            ['role' => 'Ketua', 'student_username' => '21687', 'order' => 1],
            ['role' => 'Wakil Ketua', 'student_username' => '21676', 'order' => 2],
            ['role' => 'Sekertaris 1', 'student_username' => '21692', 'order' => 3],
            ['role' => 'Sekertaris 2', 'student_username' => '21674', 'order' => 4],
            ['role' => 'Bendahara 1', 'student_username' => '21688', 'order' => 5],
            ['role' => 'Bendahara 2', 'student_username' => '21669', 'order' => 6],
            ['role' => 'Tim IT 1', 'student_username' => '21673', 'order' => 7],
            ['role' => 'Tim IT 2', 'student_username' => '21676', 'order' => 8],
            ['role' => 'Tim IT 3', 'student_username' => '21661', 'order' => 9],
            ['role' => 'Tim IT 4', 'student_username' => '21695', 'order' => 10],
            ['role' => 'Tim PDD 1', 'student_username' => '21662', 'order' => 11],
            ['role' => 'Tim PDD 2', 'student_username' => '21684', 'order' => 12],
            ['role' => 'Tim PDD 3', 'student_username' => '21679', 'order' => 13],
        ];

        foreach ($structures as $structure) {
            ClassStructure::create($structure);
        }
    }
}
