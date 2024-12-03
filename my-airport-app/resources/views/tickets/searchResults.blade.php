@extends('app')

@section('content')
<div class="container mx-auto max-w-5xl mt-12 p-6 bg-white rounded-lg shadow-md">
    @if($tickets->isEmpty())
        <div class="text-center text-gray-700 text-lg font-medium pt-7">
            Sorry, No Tickets Found
        </div>
    @else
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Search Results</h1>
        <p class="mb-4">
            <strong class="font-medium text-gray-700">Source:</strong> <span class="text-gray-800">{{ $sourceAirport->name }}</span>
        </p>
        <p class="mb-6">
            <strong class="font-medium text-gray-700">Destination:</strong> <span class="text-gray-800">{{ $destinationAirport->name }}</span>
        </p>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 shadow-sm bg-white rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Date</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Class</th>
                        <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Price</th>
                        @if(auth()->check() && auth()->user()->email_verified_at)
                            <th class="px-4 py-2 border-b border-gray-200 text-left text-sm font-medium text-gray-700">Quantity</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        @php
                            $remainingTickets = $remainingQuantities[$ticket->id] ?? 3;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->date->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">{{ $ticket->class }}</td>
                            <td class="px-4 py-2 border-b border-gray-200 text-gray-800">${{ $ticket->price }}</td>
                            @if(auth()->check() && auth()->user()->email_verified_at)
                                <td class="px-4 py-2 border-b border-gray-200 text-gray-800">
                                    @if($remainingTickets > 0)
                                        <form action="{{ route('tickets.buy') }}" method="POST" class="space-y-2 flex">
                                            @csrf
                                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                            <div class="flex items-center space-x-2 mr-7">
                                                <label for="quantity-{{ $ticket->id }}" class="text-sm font-medium text-gray-700">Quantity:</label>
                                                <input
                                                    type="number"
                                                    id="quantity-{{ $ticket->id }}"
                                                    name="quantity"
                                                    min="1"
                                                    max="{{ $remainingTickets }}"
                                                    value="1"
                                                    required
                                                    class="w-16 p-1 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                                >
                                            </div>
                                            <div class="text-sm text-gray-700 mr-7 pt-1">
                                                <span>Total Price: </span>
                                                <span id="total-price-{{ $ticket->id }}">${{ $ticket->price }}</span>
                                            </div>
                                            <button
                                                type="submit"
                                                class="px-4 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200"
                                            >
                                                Purchase
                                            </button>
                                        </form>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const quantityInput = document.getElementById('quantity-{{ $ticket->id }}');
                                                const totalPriceDisplay = document.getElementById('total-price-{{ $ticket->id }}');
                                                const ticketPrice = {{ $ticket->price }};
                                                
                                                quantityInput.addEventListener('input', function() {
                                                    const quantity = parseInt(quantityInput.value) || 1;
                                                    totalPriceDisplay.textContent = (quantity * ticketPrice).toFixed(2);
                                                });
                                            });
                                        </script>
                                    @else
                                        <p class="text-sm text-red-600">You can't buy more than 3 tickets for this flight.</p>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="mt-6">
        {{ $tickets->links('pagination::tailwind') }}
    </div>
</div>
@endsection
