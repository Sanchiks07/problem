<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealityAnchor extends Model
{
    protected $fillable = [
        'intention_questions',
        'surrounding_questions',
        'stuck_questions',
        'state_check_questions',
        'orientation_questions',
    ];

    protected $casts = [
        'intention_questions' => 'json',
        'surrounding_questions' => 'json',
        'stuck_questions' => 'json',
        'state_check_questions' => 'json',
        'orientation_questions' => 'json',
    ];
}
