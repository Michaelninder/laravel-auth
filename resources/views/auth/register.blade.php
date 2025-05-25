@extends('layouts.auth')

@section('auth_content')
    <h2 class="text-xl font-semibold mb-4">{{ __('auth.register') }}</h2>

    <button class="discord-login-btn mb-4" type="button" onclick="location.href='{{ route('discord.redirect') }}'">
        <i class="fab fa-discord" aria-hidden="true"></i>
        {{ __('auth.register_with_discord') }}
    </button>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Email</label>
        <input type="email" name="email" class="input w-full" required>

        <label class="mt-4">Password</label>
        <input type="password" name="password" class="input w-full" required>

        <label class="mt-4">Confirm Password</label>
        <input type="password" name="password_confirmation" class="input w-full" required>

        <button class="btn w-full mt-4"><i class="fas fa-user-plus"></i> {{ __('auth.register') }}</button>
    </form>

    <div class="mt-4 text-sm text-center">
        {{ __('auth.already_account') }} <a href="{{ route('login') }}" class="text-blue-500">{{ __('auth.login') }}</a>
    </div>
@endsection
