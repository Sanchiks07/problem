<x-layout>
    <x-slot:title>
        Create Task
    </x-slot:title>

    <div class="main-container">
        <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
            @csrf
            <h1>Create Task</h1>

            @if ($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="text" name="title" placeholder="Title" value ="{{ old('title') }}" required><br>
            <select name="emotional_weight" required>
                <option value="" selected disabled>Select Emotional Weight</option>
                <option value="low" {{ old('emotional_weight') == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('emotional_weight') == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('emotional_weight') == 'high' ? 'selected' : '' }}>High</option>
                <option value="overwhelming" {{ old('emotional_weight') == 'overwhelming' ? 'selected' : '' }}>Overwhelming</option>
            </select><br>
            <input type="date" name="due_date" value="{{ old('due_date') }}" required><br>

            <button type="submit">Create Task & Add Steps</button>
        </form>
    </div>
</x-layout>