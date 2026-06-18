<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassStructure extends Model
{
    protected $fillable = [
        'student_username',
        'role',
        'order'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_username', 'username');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_username', 'username');
    }
}
