<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home / Landing Page
/*
Route::get('/', function () {
    return view('pages.home'); 
})->name('home');
*/

Route::view('/', 'pages.home')->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login')->with('status', __('auth.logout_success'));
})->name('logout')->middleware('auth');

// Password change
Route::get('/password/change', [AuthController::class, 'showPasswordChangeForm'])->name('password.change')->middleware('auth');
Route::post('/password/change', [AuthController::class, 'changePassword'])->name('change-password')->middleware('auth');

// Discord OAuth
Route::get('/discord/redirect', [AuthController::class, 'redirectToDiscord'])->name('discord.redirect');
Route::get('/discord/callback', [AuthController::class, 'handleDiscordCallback']);

// Optional: Dashboard or auth landing
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');
