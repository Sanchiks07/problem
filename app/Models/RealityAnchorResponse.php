<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealityAnchorResponse extends Model
{
    protected $table = 'reality_anchors_responses';
    
    protected $fillable = [
        'user_id',
        'chosen_question',
        'response',
    ];
}
