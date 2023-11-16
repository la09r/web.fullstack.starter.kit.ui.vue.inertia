<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @routes
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @inertiaHead
</head>
<body>
<div>
    @include('auth.nav.dashboard', ['title' => __('Dashboard'), 'link' => route('route.dashboard') ]);
</div>
    @inertia
</body>
</html>
