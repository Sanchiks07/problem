<x-layout>
    <x-slot:title>
        Action Log
    </x-slot:title>

    <div class="main-container">
        <h1>Action Log (Last 24 Hours)</h1>
        <button onClick="window.location.href='{{ route('tasks.index') }}'">Back to Tasks</button>

        @if($logs->isEmpty())
            <p>No activity in the last 24 hours.</p>
        @else
            <ul class="log-list">
                @foreach($logs as $log)
                    <li>
                        <strong>{{ ucfirst($log->type) }}:</strong> {{ $log->action }} <br>
                        <em>{{ $log->details }}</em> <br>
                        <small>{{ $log->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layout>