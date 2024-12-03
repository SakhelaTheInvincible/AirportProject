@extends('app')

@section('content')
<div class="container mx-auto max-w-md mt-12 p-6 bg-white rounded-lg shadow-md">
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-300 rounded text-red-700">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-xl font-semibold text-gray-800 mb-6 text-center">Login</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <button
            type="submit"
            class="w-full mt-[20px] py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200"
        >
            Login
        </button>
    </form>
</div>
@endsection
