@extends('app')

@section('content')
<div class="container mx-auto max-w-lg mt-12 p-6 bg-white rounded-lg shadow-md">
    <header class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 text-center">Find Flights</h1>
    </header>

    <main>
        <form action="{{ route('tickets.search') }}" method="GET" class="space-y-6">
            @csrf
            <div>
                <label for="source_airport_id" class="block text-sm font-medium text-gray-700">Source Airport:</label>
                <select
                    name="source_airport_id"
                    id="source_airport_id"
                    required
                    class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
                    @foreach($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="destination_airport_id" class="block text-sm font-medium text-gray-700">Destination Airport:</label>
                <select
                    name="destination_airport_id"
                    id="destination_airport_id"
                    required
                    class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
                    @foreach($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date (optional):</label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    class="mt-1 block w-full p-2.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div>
                <button
                    type="submit"
                    class="w-full py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200"
                >
                    Find Tickets
                </button>
            </div>
        </form>
    </main>

</div>
@endsection
