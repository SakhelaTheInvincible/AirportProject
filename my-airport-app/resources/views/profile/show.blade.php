@extends('app')

@section('content')
<div class="container mx-auto max-w-4xl mt-12 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Your Profile</h1>

    <div class="space-y-2 mb-6">
        <p><strong class="font-medium text-gray-700">First Name:</strong> <span class="text-gray-800">{{ $user->first_name }}</span></p>
        <p><strong class="font-medium text-gray-700">Last Name:</strong> <span class="text-gray-800">{{ $user->last_name }}</span></p>
        <p><strong class="font-medium text-gray-700">Email:</strong> <span class="text-gray-800">{{ $user->email }}</span></p>
    </div>

    <a
        href="{{ route('profile.edit') }}"
        class="inline-block px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200"
    >
        Edit Profile
    </a>

    <h2 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Your Tickets</h2>

    @if($tickets->isEmpty())
        <p class="text-gray-600">You have not purchased any tickets yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 shadow-sm bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Source</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Destination</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Class</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Quantity</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->sourceAirport->name }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->destinationAirport->name }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->date->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->class }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->pivot->quantity }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">${{ $ticket->price * $ticket->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
