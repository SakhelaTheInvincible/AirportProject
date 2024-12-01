@extends('app')

@section('content')
    <form method="GET" action="{{ route('tickets.search') }}">
        <select name="source">
            @foreach ($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->name }}</option>
            @endforeach
        </select>
        <select name="destination">
            @foreach ($airports as $airport)
                <option value="{{ $airport->id }}">{{ $airport->name }}</option>
            @endforeach
        </select>
        <input type="date" name="date">
        <button type="submit">Find Tickets</button>
    </form>

    @foreach ($tickets as $ticket)
        <div>
            <p>{{ $ticket->class }} - ${{ $ticket->price }}</p>
            <form method="POST" action="{{ route('tickets.buy') }}">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <input type="number" name="quantity" min="1" max="3">
                <button type="submit">Buy</button>
            </form>
        </div>
    @endforeach
    
@endsection