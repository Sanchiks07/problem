<x-layout>
    <x-slot:title>
        Failed Tasks
    </x-slot:title>

    <div class="main-container">
        <h1 class="failed-title">Failed Tasks</h1>

        @if($failedTasks->isEmpty())
            <p>No failed tasks yet.</p>
        @else
            <ul class="task-list">
                @foreach($failedTasks as $task)
                    <li class="task-item failed">
                        <h2>{{ $task->title }}</h2>
                        <p><strong>Emotional Weight:</strong> {{ ucfirst($task->emotional_weight) }}</p>
                        <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p><br>

                        <div class="failed-actions">
                            <form action="{{ route('tasks.updateDueDate', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf

                                <input type="date" name="due_date" required>
                                <button type="submit">Set New Due Date</button>
                            </form>

                            <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" onClick="return confirm('Are you sure you want to delete this task?')">Delete Task</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>