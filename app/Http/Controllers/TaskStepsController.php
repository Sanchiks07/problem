<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\TaskStep;
use App\Models\ActionLog;

class TaskStepsController extends Controller
{
    public function create($task_id) {
        return view('steps.create', ['task_id' => $task_id]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'task_id' => 'required|integer|exists:tasks,id',
            'steps' => 'required|string',
        ]);

        $stepsArray = array_filter(
            array_map('trim', explode("\n", $validatedData['steps']))
        );

        TaskStep::create([
            'task_id' => $validatedData['task_id'],
            'steps' => $stepsArray,
        ]);

        return redirect()->route('tasks.index');
    }

    public function show(Request $request, $task_id) {
        $task = Task::where('id', $task_id)->where('user_id', auth()->id())->firstOrFail();

        $taskSteps = TaskStep::where('task_id', $task_id)->first();

        $steps = $taskSteps ? $taskSteps->steps : [];

        $currentIndex = $request->query('step', 0);

        return view('steps.show', ['task' => $task, 'steps' => $steps, 'currentIndex' => $currentIndex]);
    }
}
