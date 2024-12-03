<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    @vite('resources/js/app.js')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    <header class="bg-blue-600 text-white shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <ul class="flex space-x-6">
                <li><a href="{{ route('homepage') }}" class="hover:underline">Homepage</a></li>
                @if(auth()->user() && auth()->user()->is_admin)
                    <li><a href="{{ route('admin.tickets') }}" class="hover:underline">Tickets</a></li>
                @endif
                @if(auth()->check())
                    <li><a href="{{ route('profile') }}" class="hover:underline">Profile</a></li>
                    @if(is_null(auth()->user()->email_verified_at))
                        <li><a href="{{ route('verification.notice') }}" class="hover:underline">Verify Email</a></li>
                    @endif
                @endif
            </ul>
            <ul class="flex space-x-6">
                @if(auth()->check())
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-md shadow hover:bg-red-600">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="hover:underline">Login</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline">Register</a></li>
                @endif
            </ul>
        </nav>
    </header>
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>
</body>
</html>
