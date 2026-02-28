<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\RealityAnchor;
use App\Models\RealityAnchorResponse;
use App\Models\ActionLog;

class RealityAnchorsController extends Controller
{
    public static function show() {
        $anchorRow = RealityAnchor::first();
        $anchorQuestion = null;
        $userResponse = null;

        if ($anchorRow) {
            $questions = $anchorRow->intention_questions ?? [];

            if (!empty($questions)) {
                $timeBlock = floor(Carbon::now()->timestamp / (60 * 60 * 4));
                $index = $timeBlock % count($questions);
                $anchorQuestion = $questions[$index];

                // Check if user already answered
                $existingResponse = RealityAnchorResponse::where('user_id', Auth::id())
                    ->where('chosen_question', $anchorQuestion)
                    ->latest()
                    ->first();

                $userResponse = $existingResponse ? $existingResponse->response : null;
            }
        }

        return [$anchorQuestion, $userResponse];
    }

    public static function save(Request $request) {
        $data = $request->validate([
            'chosen_question' => 'required|string',
            'response' => 'nullable|string',
        ]);

        RealityAnchorResponse::create([
            'user_id' => Auth::id(),
            'chosen_question' => $data['chosen_question'],
            'response' => $data['response'] ?? null,
        ]);

        // logs reality anchor response
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'reality anchor',
            'action' => 'responded',
            'details' => $request->chosen_question . ' | ' . ($request->response ?? 'no answer'),
        ]);

        return redirect()->route('tasks.index');
    }
}
