@extends('layouts.auth')

@section('auth_content')
    <h2 class="text-xl font-semibold mb-4">{{ __('auth.change_password') }}</h2>

    <form method="POST" action="{{ route('change-password') }}">
        @csrf

        <label>{{ __('auth.current_password') }}</label>
        <input type="password" name="current_password" class="input w-full" required>

        <label class="mt-4">{{ __('auth.new_password') }}</label>
        <input type="password" name="new_password" class="input w-full" required>

        <label class="mt-4">{{ __('auth.new_password_confirmation') }}</label>
        <input type="password" name="new_password_confirmation" class="input w-full" required>

        <button class="btn w-full mt-4"><i class="fas fa-key"></i> {{ __('auth.change_password') }}</button>
    </form>
@endsection
