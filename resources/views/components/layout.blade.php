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
        $hour = \Carbon\Carbon::now()->hour;
        $currentRoute = request()->route()->getName();
        $excludedRoutes = ['tasks.create', 'steps.create', 'steps.show', 'home', 'login', 'register', 'logout'];
        $showPopup = !in_array($currentRoute, $excludedRoutes) && $hour >= 18 && $hour <= 20 && empty($dailyResponses ?? []);
    @endphp

    @if($showPopup)
        <div id="daily-reflection-popup">
            <h2>Daily Reflection</h2>
            <form action="{{ route('dailyReflections.save') }}" method="POST">
                @csrf

                @foreach($dailyQuestions as $index => $question)
                    <p>{{ $question }}</p>
                    <textarea name="responses[{{ $index }}]" required style="width:100%;"></textarea>
                @endforeach
                <br>

                <button type="submit">Save</button>
                <button type="button" onclick="document.getElementById('daily-reflection-popup').style.display='none'">Close</button>
            </form>
        </div>
    @endif
</body>
</html>
