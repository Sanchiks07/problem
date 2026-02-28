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
                <div class="task-action-btns">
                    <button onClick="window.location.href='{{ route('tasks.create') }}'">Create New Task</button>
                    <button onClick="window.location.href='{{ route('tasks.failed') }}'">Failed Tasks</button>
                </div>
                
                <ul class="task-list">
                    @foreach($tasks as $task)
                        <li class="task-item" style="cursor:pointer;" onclick="startTask({{ $task->id }}, '{{ route('steps.show', $task->id) }}')">
                            <h2>{{ $task->title }}</h2>
                            <p><strong>Emotional Weight:</strong> {{ ucfirst($task->emotional_weight) }}</p>
                            <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($task->due_date)->format('d/m/Y') }}</p>

                            <div class="action-btns">
                                <div class="task-edit-btns">
                                    <a onclick="event.stopPropagation();" href="{{ route('tasks.edit', $task->id) }}">Edit Task</a>
                                    <a onclick="event.stopPropagation();" href="{{ route('steps.edit', $task->id) }}">Edit Steps</a>
                                </div>

                                <form action="{{ route('tasks.delete', $task->id) }}" method="POST" onClick="event.stopPropagation(); return confirm('Are you sure you want to delete this task?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="side-container">
            <div class="affirmations-container">
                <h2>Affirmation</h2>

                @if($affirmationText)
                    <p>{{ $affirmationText }}</p>
                @endif
            </div>

            <div class="anchors-container">
                <h2>Reality Anchor</h2>

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
    </div>
</x-layout>