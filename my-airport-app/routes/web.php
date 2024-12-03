<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// public routes
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('homepage')->with('success', 'Email successfully verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/login', function () {
    if (Auth::check() && is_null(Auth::user()->email_verified_at)) {
        return redirect()->route('verification.notice');
    }
    if (Auth::check()) {
        return redirect()->route('homepage');
    }
    return view('auth.login');
})->name('login');



// authentifications

Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');


Route::middleware(['auth'])->group(function () {


    // verified users
    Route::middleware(['verified'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::post('/tickets/buy', [TicketController::class, 'buy'])->name('tickets.buy');
    });



    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/tickets', function () {
            if (auth()->user()->is_admin) {
                return app(UserController::class)->index();
            }
            return redirect('/homepage')->with('error', 'You do not have admin access');
        })->name('admin.tickets');
    });
});