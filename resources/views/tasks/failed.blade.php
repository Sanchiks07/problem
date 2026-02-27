<x-layout>
    <x-slot:title>
        Failed Tasks
    </x-slot:title>

    <div class="main-container">
        <h1>Failed Tasks</h1><br>
        <button onClick="window.location.href='{{ route('tasks.index') }}'">Back to Tasks</button>

        @if($failedTasks->isEmpty())
            <p>No failed tasks yet.</p>
        @else
            <ul class="task-list">
                @foreach($failedTasks as $task)
                    <li class="task-item">
                        <h2>{{ $task->title }}</h2>
                        <p><strong>Emotional Weight:</strong> {{ ucfirst($task->emotional_weight) }}</p>
                        <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p><br><br>

                        <div class="task-actions">
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf

                                <input type="date" name="due_date" required>
                                <button type="submit">Set New Due Date</button>
                            </form><br><br>

                            <form action="{{ route('tasks.delete', $task->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" style="margin-right:10px;" onClick="return confirm('Are you sure you want to delete this task?')">Delete Task</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>