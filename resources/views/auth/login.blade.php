@extends('layouts.auth')

@section('auth_content')
    <h2 class="mb-4">{{ __('auth.login') }}</h2>

	<button class="discord-login-btn" type="button" onclick="location.href='{{ route('discord.redirect') }}'">
	    <i class="fab fa-discord" aria-hidden="true"></i>
	    {{ __('auth.login_with_discord') }}
	</button>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label class="mt-4">Email</label>
        <input type="email" name="email" class="input w-full" required>

        <label class="mt-4">Password</label>
        <input type="password" name="password" class="input w-full" required>

        <button class="btn w-full mt-4"><i class="fas fa-sign-in-alt"></i> {{ __('auth.login') }}</button>
    </form>

    <!--a href="{{ route('discord.redirect') }}" class="btn w-full mt-2 bg-indigo-600 text-white">
        <i class="fab fa-discord"></i> {{ __('auth.login_with_discord') }}
    </a-->


    <div class="mt-4 text-sm text-center">
        {{ __('auth.no_account') }} <a href="{{ route('register') }}" class="text-blue-500">{{ __('auth.register') }}</a>
    </div>
@endsection
