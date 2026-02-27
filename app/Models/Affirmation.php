<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affirmation extends Model
{
    protected $fillable = [
        'affirmations'
    ];

    protected $casts = [
        'affirmations' => 'json',
    ];
}
