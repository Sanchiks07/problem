<x-layout>
    <x-slot:title>
        Edit Task
    </x-slot:title>

    <div class="main-container">
        <form class="task-edit-form" action="{{ route('tasks.updateTask', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <h1>Edit Task</h1>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required>
            <select id="emotional_weight" name="emotional_weight" required>
                <option value="" selected disabled>Select Emotional Weight</option>
                <option value="low" {{ old('emotional_weight', $task->emotional_weight) === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('emotional_weight', $task->emotional_weight) === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('emotional_weight', $task->emotional_weight) === 'high' ? 'selected' : '' }}>High</option>
                <option value="overwhelming" {{ old('emotional_weight', $task->emotional_weight) === 'overwhelming' ? 'selected' : '' }}>Overwhelming</option>
            </select>
            <input type="date" id="due_date" name="due_date" value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d')) }}" required>

            <button type="submit">Update Task</button>
        </form>
    </div>
</x-layout>