<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'full_name',
        'nickname',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'origin_school',
        'address',
        'city',
        'child_number',
        'photo',
        'bio',
        'position',
        'is_completed',
        'github_url',
        'instagram_url',
        'tiktok_url',
        'programming_languages'
    ];

}
