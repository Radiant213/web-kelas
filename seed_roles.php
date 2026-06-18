<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$roles = [
    ['role' => 'Ketua', 'order' => 1],
    ['role' => 'Wakil Ketua', 'order' => 2],
    ['role' => 'Sekertaris 1', 'order' => 3],
    ['role' => 'Sekertaris 2', 'order' => 4],
    ['role' => 'Bendahara 1', 'order' => 5],
    ['role' => 'Bendahara 2', 'order' => 6],
    ['role' => 'Tim IT', 'order' => 7],
    ['role' => 'Tim PDD', 'order' => 8]
];

foreach($roles as $r) {
    if(!\App\Models\ClassStructure::where('role', $r['role'])->exists()){
        \App\Models\ClassStructure::create(['role' => $r['role'], 'order' => $r['order'], 'student_username' => null]);
    }
}
echo "Roles seeded successfully.\n";
