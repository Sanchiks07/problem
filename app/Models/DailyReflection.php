<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReflection extends Model
{
    protected $fillable = [
        'questions',
    ];

    protected $casts = [
        'questions' => 'json',
    ];
}
