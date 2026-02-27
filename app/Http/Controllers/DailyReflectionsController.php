<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\DailyReflection;
use App\Models\DailyReflectionResponse;

class DailyReflectionsController extends Controller
{
    public static function show() {
        $reflection = DailyReflections::first();
        $questions = $reflection ? $reflection->questions : [];

        $today = Carbon::today()->toDateString();
        $responseRow = DailyReflectionsResponse::where('user_id', auth()->id())
                        ->where('date', $today)
                        ->first();

        $responses = $responseRow ? $responseRow->responses : [];

        return [$questions, $responses];
    }

    public function store(Request $request) {
        $request->validate([
            'responses' => 'required|array',
        ]);

        $today = Carbon::today()->toDateString();

        DailyReflectionsResponse::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'date' => $today,
            ],
            [
                'responses' => $request->responses,
            ]
        );

        return redirect()->back()->with('success', 'Daily reflection saved!');
    }
}
