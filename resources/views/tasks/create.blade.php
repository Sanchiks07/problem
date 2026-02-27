<x-layout>
    <x-slot:title>
        Create Task
    </x-slot:title>

    <div class="main-container">
        <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
            @csrf

            <h1>Create Task</h1>

            <input type="text" name="title" placeholder="Title" required><br>
            <select name="emotional_weight" required>
                <option value="" selected disabled>Select Emotional Weight</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
                <option value="overwhelming">Overwhelming</option>
            </select><br>
            <input type="date" name="due_date" required><br>

            <button type="submit">Create Task & Add Steps</button>
        </form>
    </div>
</x-layout>