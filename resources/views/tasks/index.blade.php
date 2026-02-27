<x-layout>
    <x-slot:title>
        Tasks
    </x-slot:title>

    <div class="main-tasks-container">
        <div class="tasks-container">
            <h1>My Tasks</h1>

            @if($tasks->isEmpty())
                <p>You have no tasks yet. <a href="{{ route('tasks.create') }}">Create your first task</a>.</p>
            @else
                <button class="create-task" onClick="window.location.href='{{ route('tasks.create') }}'">Create New Task</button>
                <button onClick="window.location.href='{{ route('tasks.failed') }}'">Failed Tasks</button>

                <ul class="task-list">
                    @foreach($tasks as $task)
                        <li class="task-item" style="cursor:pointer;" onclick="startTask({{ $task->id }}, '{{ route('steps.show', $task->id) }}')">
                            <h2 style="margin-bottom:15px;">{{ $task->title }}</h2>
                            <p><strong>Emotional Weight:</strong> {{ ucfirst($task->emotional_weight) }}</p>
                            <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="affirmations-container">
            @if($affirmationText)
                <p>{{ $affirmationText }}</p>
            @endif
        </div>

        <div class="anchors-container">
            @if($anchorQuestion)
                <div class="anchor-box">
                    <p>{{ $anchorQuestion }}</p>

                    @if($userResponse)
                        <p class="user-answer">Your answer: {{ $userResponse }}</p>
                    @else
                        <form id="anchor-form" action="{{ route('anchors.save') }}" method="POST">
                            @csrf

                            <input type="hidden" name="chosen_question" value="{{ $anchorQuestion }}">
                            <textarea type="text" name="response" placeholder="Your answer (optional)"></textarea><br>
                            <button type="submit">Save Answer</button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-layout>