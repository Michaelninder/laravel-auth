<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME', 'Laravel Auth') }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom CSS -->
	<link rel="stylesheet" href="{{ asset('css/base.css') }}">
	<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
	<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
	<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
	<link rel="stylesheet" href="{{ asset('css/form.css') }}">
	<link rel="stylesheet" href="{{ asset('css/alert.css') }}">
	<link rel="stylesheet" href="{{ asset('css/utils.css') }}">
	<link rel="stylesheet" href="{{ asset('css/pages.css') }}">

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    @yield('body')
</body>
</html>
