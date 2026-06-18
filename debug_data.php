<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$student = App\Models\Student::where('username', '21687')->first();
if ($student) {
    echo "Student Found:\n";
    echo "ID: " . $student->id . "\n";
    echo "Full Name: '" . $student->full_name . "'\n";
    echo "Photo: '" . $student->photo . "'\n";
    echo "User ID: " . $student->user_id . "\n";
} else {
    echo "Student NOT Found\n";
}

$cs = App\Models\ClassStructure::where('student_username', '21687')->first();
if ($cs) {
    echo "\nClass Structure Found:\n";
    echo "Role: " . $cs->role . "\n";
    echo "Student Relation: " . ($cs->student ? 'Loaded' : 'Null') . "\n";
} else {
    echo "\nClass Structure NOT Found\n";
}
