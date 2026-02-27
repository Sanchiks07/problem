<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Task;
use App\Models\DailyReflectionResponse;

class CalendarController extends Controller
{
    public function index() {
        $userId = auth()->id();

        $tasks = Task::where('user_id', $userId)->select('id', 'title', 'due_date')->get();

        $reflections = DailyReflectionResponse::where('user_id', $userId)->get();

        return view('calendar.index', compact('tasks', 'reflections'));
    }
}
