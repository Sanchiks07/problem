<x-layout>
    <x-slot:title>
        {{ $task->title }}
    </x-slot:title>

    <div class="main-container">
        <div class="task-steps">
            <h1 class="task-title">{{ $task->title }}</h1>
            <p class="task-subtitle">One small step at a time.</p>

            @if(isset($steps[$currentIndex]))

                <div class="progress-bar">
                    <div class="progress-fill" style="width:{{ (($currentIndex + 1) / count($steps)) * 100 }}%"></div>
                </div>

                <div class="current-step">
                    <p>{{ $steps[$currentIndex] }}</p>
                </div>

                <div>
                    @if($currentIndex + 1 < count($steps))
                        <a href="{{ route('steps.show', $task->id) }}?step={{ $currentIndex + 1 }}">
                            <button>Next Step</button>
                        </a>
                    @else
                        <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                            @csrf
                            <button type="submit">Finish Task</button>
                        </form>
                    @endif
                </div>

            @else
                <p>No steps found.</p>
            @endif
        </div>
    </div>
</x-layout>