@extends('app')

@section('content')
    @if($tickets->isEmpty())
        <div class="no-tickets-message">
            Sorry, No Tickets Found
        </div>
    @else
        <h1>Search Results</h1>
        <p><strong>Source:</strong> {{ $sourceAirport->name }}</p>
        <p><strong>Destination:</strong> {{ $destinationAirport->name }}</p>

        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Price</th>
                    @if(auth()->check() && auth()->user()->email_verified_at)
                        <th>Quantity</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    @php
                        $remainingTickets = $remainingQuantities[$ticket->id] ?? 3; // Fallback to 3 if not set
                    @endphp
                    <tr>
                        <td>{{ $ticket->date->format('d-m-Y') }}</td>
                        <td>{{ $ticket->class }}</td>
                        <td>{{ $ticket->price }}</td>
                        @if(auth()->check() && auth()->user()->email_verified_at)
                            <td>
                                @if($remainingTickets > 0)
                                    <form action="{{ route('tickets.buy') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                        <label for="quantity-{{ $ticket->id }}">Quantity:</label>
                                        <input type="number" id="quantity-{{ $ticket->id }}" name="quantity" min="1" max="{{ $remainingTickets }}" value="1" required>
                                        
                                        <div>
                                            <span>Total Price: </span>
                                            <span id="total-price-{{ $ticket->id }}">{{ $ticket->price }}</span>
                                        </div>
                                        
                                        <button type="submit">Purchase</button>
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
                                    <p>You can't buy more than 3 tickets for this flight.</p>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="pagination">
        {{ $tickets->links() }}
    </div>
@endsection