<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\RealityAnchorsController;
use App\Models\Task;
use App\Models\TaskStep;
use App\Models\Affirmation;
use App\Models\ActionLog;

class TasksController extends Controller
{
    public function index() {
        $tasks = Task::where('user_id', auth()->id())->whereNotIn('status', ['failed', 'completed'])->with('steps')->get();

        // makes sure any overdue tasks are marked as failed
        foreach($tasks as $task) {
            $taskDue = Carbon::parse($task->due_date);
            if($taskDue->lt(Carbon::today()) && !in_array($task->status, ['completed','in_progress'])) {
                $task->update(['status' => 'failed']);
            }
        }

        $failedTasks = Task::where('user_id', auth()->id())->where('status', 'failed')->get();

        $affirmationText = null;
        $affirmationRow = Affirmation::first();

        if ($affirmationRow && is_array($affirmationRow->affirmations)) {
            $affirmations = $affirmationRow->affirmations;
            $timeBlock = floor(Carbon::now()->timestamp / (60 * 60 * 8));
            $index = $timeBlock % count($affirmations);
            $affirmationText = $affirmations[$index];
        }

        [$anchorQuestion, $userResponse] = RealityAnchorsController::show();

        return view('tasks.index', compact('tasks', 'affirmationText', 'anchorQuestion', 'userResponse'));
    }

    public function create() {
        return view('tasks.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'emotional_weight' => 'required|string|in:low,medium,high,overwhelming',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $validatedData['user_id'] = auth()->id();

        $task = Task::create($validatedData);

        // log task creation
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'task',
            'action' => 'created',
            'details' => $task->title,
        ]);

        return redirect()->route('steps.create', ['task_id' => $task->id]);
    }

    public function edit($id) {
        $id = request()->route('id');

        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('tasks.edit', ['task' => $task]);
    }

    public function updateTask(Request $request, $id) {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $validatedData = $request->validate([
            'title' => 'required|string|max:20',
            'emotional_weight' => 'required|string|in:low,medium,high,overwhelming',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task->update($validatedData);

        // log task update
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'task',
            'action' => 'updated',
            'details' => $task->title,
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy() {
        $task = Task::where('id', request()->id)->where('user_id', auth()->id())->firstOrFail();
        $task->delete();

        // log task deletion
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'task',
            'action' => 'deleted',
            'details' => $task->title,
        ]);

        return redirect()->route('tasks.index');
    }

    // functions for starting, completing, failing, updating due date, and deleting failed tasks
    public function start($id) {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        if($task->status === 'pending') {
            $task->update(['status' => 'in_progress']);
        }

        // logs task start
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'task',
            'action' => 'started',
            'details' => $task->title,
        ]);

        return response()->json(['success' => true]);
    }

    public function complete($id) {
        $task = Task::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        $task->update(['status' => 'completed']);

        // logs task completion
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'task',
            'action' => 'completed',
            'details' => $task->title,
        ]);

        return redirect()->route('tasks.index');
    }

    public function failed() {
        $failedTasks = Task::where('user_id', auth()->id())->where('status', 'failed')->get();

        return view('tasks.failed', compact('failedTasks'));
    }

    public function updateDueDate(Request $request, $id) {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $task->update([
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        // logs failed task update
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'failed task',
            'action' => 'due date updated',
            'details' => $task->title . ' → ' . $task->due_date,
        ]);

        return redirect()->route('tasks.failed');
    }

    public function destroyFailed($id) {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->delete();

        // logs task deletion
        ActionLog::create([
            'user_id' => auth()->id(),
            'type' => 'failed task',
            'action' => 'deleted',
            'details' => $task->title,
        ]);

        return redirect()->route('tasks.failed');
    }
}
