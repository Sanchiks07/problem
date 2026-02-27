<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ActionLog;

class ActionLogsController extends Controller
{
    public function index() {
        $logs = ActionLog::where('user_id', auth()->id())
                        ->where('created_at', '>=', Carbon::now()->subDay())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('logs.index', compact('logs'));
    }
}
