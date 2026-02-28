<x-layout>
    <x-slot:title>
        Add Steps
    </x-slot:title>

    <div class="main-container">
        <form action="{{ route('steps.store') }}" method="POST" class="task-form">
            @csrf

            <h1>Add Steps to Your Task</h1>
            <p>Write each step of your task on a new line.</p>

            <input type="hidden" name="task_id" value="{{ $task_id }}">
            <textarea name="steps" placeholder="Step 1&#10;Step 2&#10;Step 3" required></textarea><br>

            <button type="submit">Save Steps & View Task</button>
        </form>
    </div>
</x-layout>