@unless (request()->routeIs('login') || request()->routeIs('register'))
<nav class="navigation">
    <ul class="nav-left">
        @guest
            <li style="margin-left:60px;"><a href="#about">About</a></li>
            <li><a href="#reviews">Reviews</a></li>
        @endguest

        @auth
            <li><a href="{{ route('tasks.index') }}">My Tasks</a></li>
            <li><a href="{{ route('calendar.index') }}">Calendar</a></li>
            <li><a href="{{ route('logs.index') }}">Action Log</a></li>
        @endauth
    </ul>

    <div class="nav-center">
        <a href="#introduction" id="web-name">BrainSpace</a>
    </div>

    <ul class="nav-right">
        @guest
            <li style="margin-right:60px;"><a href="{{ route('login') }}">Login</a></li>
        @endguest

        @auth
            <li style="cursor:default; color:white;">Welcome, {{ auth()->user()->name }}!</li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>
@endunless
