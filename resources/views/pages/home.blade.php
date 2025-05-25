@extends('layouts.main')

@section('content')
<div class="home-container">
    <div class="home-hero">
        <h1 class="home-title">Welcome to {{ env('APP_NAME') }}</h1>
        <p class="home-subtitle">
            Your Authentication Plattform by michaelninder
        </p>
        @auth
            <a href="{{ route('dashboard') }}" class="home-btn">Go to Dashboard</a>
        @else
            <a href="{{ route('register') }}" class="home-btn">Get Started</a>
        @endauth
    </div>
</div>
@endsection
