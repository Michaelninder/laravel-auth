@extends('layouts.app')

@section('body')
    @include('components.navbar')

    <main class="container">
        @include('components.alert')
        @yield('content')
    </main>

    @include('components.footer')
@endsection
