@extends('app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Admin - All Purchased Tickets</h1>

    @if($users->isEmpty())
        <p class="text-gray-600 text-lg">No users have purchased tickets yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 shadow-sm bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">User Email</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Source Airport</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Destination Airport</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Class</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Quantity</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Total Price</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Last Purchase Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @foreach($user->tickets as $ticket)
                            @foreach($ticket->users as $userTicket) <!-- Loop over each user for each ticket -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $user->email }}</td>
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->sourceAirport->name }}</td> 
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->destinationAirport->name }}</td> 
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->date }}</td>
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->class }}</td>
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $userTicket->pivot->quantity }}</td>
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">${{ $ticket->price * $userTicket->pivot->quantity }}</td>
                                    <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $userTicket->pivot->updated_at }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $users->links('pagination::tailwind') }}
        </div>
    @endif
</div>
@endsection
