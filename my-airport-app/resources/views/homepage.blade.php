

@extends('app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Tickets</title>
</head>
<body>
    <header>
        <h1>Find Flights</h1>
    </header>

    <main>
        <form action="{{ route('tickets.search') }}" method="GET">
            @csrf
            <div>
                <label for="source_airport_id">Source Airport:</label>
                <select name="source_airport_id" id="source_airport_id" required>
                    @foreach($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="destination_airport_id">Destination Airport:</label>
                <select name="destination_airport_id" id="destination_airport_id" required>
                    @foreach($airports as $airport)
                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date">Date (optional):</label>
                <input type="date" name="date" id="date">
            </div>

            <div>
                <button type="submit">Find Tickets</button>
            </div>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Your Company. All Rights Reserved.</p>
    </footer>
</body>
</html>
@endsection