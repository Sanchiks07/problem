<x-layout>
    <x-slot:title>
        Edit Steps
    </x-slot:title>

    <div class="main-container">
        <form class="task-edit-form" action="{{ route('steps.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <h1>Edit Steps for Task: {{ $task->title }}</h1>
            <p>Write each step of your task on a new line.</p>

            <input type="hidden" name="task_id" value="{{ $task->id }}">
            <textarea name="steps" placeholder="Step 1&#10;Step 2&#10;Step 3" required>{{ old('steps', implode("\n", $steps)) }}</textarea><br>

            <button type="submit">Update Steps</button>
        </form>
    </div>
</x-layout>