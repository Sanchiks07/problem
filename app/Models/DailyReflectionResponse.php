<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReflectionResponse extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'responses',
    ];

    protected $casts = [
        'responses' => 'json',
    ];
}
