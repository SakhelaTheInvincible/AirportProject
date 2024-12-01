<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    @vite('resources/js/app.js')
</head>
<body>
    <header>
        <nav>
        <ul>
            <li><a href="{{ route('homepage') }}">Homepage</a></li>
            @if(auth()->user() && auth()->user()->is_admin)
                <li><a href="{{ route('admin.tickets') }}">Tickets</a></li>
            @endif
            
            @if(auth()->check())
                <li><a href="{{ route('profile') }}">Profile</a></li>
                @if(is_null(auth()->user()->email_verified_at))
                    <li><a href="{{ route('verification.notice') }}">Verify Email</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endif
        </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>