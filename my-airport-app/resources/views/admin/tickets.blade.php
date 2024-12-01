@extends('app')

@section('content')
    <div class="container">
        <h1>Admin - All Purchased Tickets</h1>

        @if($users->isEmpty())
            <p>No users have purchased tickets yet.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>User Email</th>
                        <th>Source Airport</th>
                        <th>Destination Airport</th>
                        <th>Date</th>
                        <th>Class</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Last Purchase Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @foreach($user->tickets as $ticket)
                            @foreach($ticket->users as $userTicket) <!-- Loop over each user for each ticket -->
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $ticket->sourceAirport->name }}</td> 
                                    <td>{{ $ticket->destinationAirport->name }}</td> 
                                    <td>{{ $ticket->date }}</td>
                                    <td>{{ $ticket->class }}</td>
                                    <td>{{ $userTicket->pivot->quantity }}</td>
                                    <td>{{ $ticket->total_price }}</td>
                                    <td>{{ $userTicket->pivot->updated_at }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        @endif
    </div>
@endsection