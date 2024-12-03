@extends('app')

@section('content')
<div class="container mx-auto max-w-md mt-12 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-xl font-semibold text-gray-800 mb-4 text-center">Verify Your Email Address</h1>
    <p class="text-gray-600 text-sm mb-4 text-center">
        Before proceeding, please check your email for a verification link.
    </p>
    <p class="text-gray-600 text-sm mb-6 text-center">
        If you did not receive the email, you can request another below.
    </p>
    <form method="POST" action="{{ route('verification.send') }}" class="text-center">
        @csrf
        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md shadow hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-200"
        >
            Resend Verification Email
        </button>
    </form>
</div>
@endsection
