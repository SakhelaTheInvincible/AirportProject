@extends('app')

@section('content')

@if ($errors->any())
    <div class="error-messages">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <div>
        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required>
        @error('email')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <div>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required>
        @error('password')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit">Login</button>
</form>

@endsection