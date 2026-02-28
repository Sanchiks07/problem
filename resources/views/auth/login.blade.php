<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
    
    <div class="main-container">
        <div class="auth-page">
            <div class="auth-image">
                <a href="{{ route('home') }}">Back to website →</a>
            </div>

            <form action="{{ route('login.store') }}" method="POST" class="auth-form">
                @csrf

                <h1>Login</h1>
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>

                @if ($errors->any())
                    <div class="error-messages">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</x-layout>