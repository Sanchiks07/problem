<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? "BrainSapce" }}</title>
    <!-- style -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <!-- regular javascript -->
    <script>window.Laravel = {csrfToken: '{{ csrf_token() }}'};</script>
    <script src="{{ asset('script.js') }}" defer></script>
    <!-- calendar -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
</head>
<body>
    <x-navigation></x-navigation>

    {{ $slot }}

    <!-- daily reflection popup -->
    @php
        $currentRoute = request()->route()->getName();
        $excludedRoutes = ['tasks.create', 'steps.create', 'steps.show', 'home', 'login', 'register', 'logout'];
        $showPopup = !in_array($currentRoute, $excludedRoutes) && empty($dailyResponses ?? []);
    @endphp

    @if($showPopup)
        <div id="daily-reflection-popup" style="display:none;">
            <h2>Daily Reflection</h2>
            
            <form action="{{ route('dailyReflections.save') }}" method="POST">
                @csrf

                @foreach($dailyQuestions as $index => $question)
                    <p>{{ $question }}</p>
                    <textarea name="responses[{{ $index }}]" required></textarea>
                @endforeach
                <br>

                <button type="submit">Save</button>
                <button type="button" id="daily-popup-close">Close</button>
            </form>
        </div>
    @endif
</body>
</html>
