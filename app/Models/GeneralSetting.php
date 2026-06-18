<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_image',
        'about_image',
        'teacher_image',
        'teacher_quote',
    ];
    //
}
