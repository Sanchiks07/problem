<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>
    
    <div class="auth-container">
        <div class="auth-page">
            <div class="auth-image">
                <a href="{{ route('home') }}">Back to website →</a>
            </div>
            
            <form action="{{ route('register.store') }}" method="POST" class="auth-form">
                @csrf

                <div class="auth-back">
                    <a href="{{ route('home') }}">Back to website →</a>
                </div>

                <h1>Register</h1>
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>

                @if ($errors->any())
                    <div class="error-messages">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</x-layout>