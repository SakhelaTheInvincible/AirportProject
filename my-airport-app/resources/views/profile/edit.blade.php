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

    <h1 class="text-xl font-semibold text-gray-800 mb-6 text-center">Edit Profile</h1>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input
                type="text"
                id="first_name"
                name="first_name"
                value="{{ old('first_name', $user->first_name) }}"
                class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
            @error('first_name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input
                type="text"
                id="last_name"
                name="last_name"
                value="{{ old('last_name', $user->last_name) }}"
                class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
            @error('last_name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">New Password (Leave blank if unchanged)</label>
            <input
                type="password"
                id="password"
                name="password"
                class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
            @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
            >
            @error('password_confirmation')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200"
            >
                Save Changes
            </button>
            <a
                href="{{ route('profile') }}"
                class="px-4 py-2 bg-gray-300 text-gray-800 font-medium rounded-md shadow hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-200"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
