<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStep extends Model
{
    protected $fillable = [
        'task_id',
        'steps',
    ];

    protected $casts = [
        'steps' => 'json',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
