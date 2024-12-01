@extends('app')

@section('content')
<div class="container">
    <h1>Your Profile</h1>

    <div>
        <p><strong>First Name:</strong> {{ $user->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>

    <a href="{{ route('profile.edit') }}" class="btn btn-secondary mt-3">Edit Profile</a>

    <h2 class="mt-5">Your Tickets</h2>

    @if($tickets->isEmpty())
        <p>You have not purchased any tickets yet.</p>
    @else
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Class</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->sourceAirport->name }}</td>
                        <td>{{ $ticket->destinationAirport->name }}</td>
                        <td>{{ $ticket->date->format('d-m-Y') }}</td>
                        <td>{{ $ticket->class}}</td>
                        <td>{{ $ticket->pivot->quantity }}</td>
                        <td>{{ $ticket->price * $ticket->pivot->quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection