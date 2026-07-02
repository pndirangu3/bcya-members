<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BCYA Administrator Portal')</title>

       @vite([
    'resources/css/bcya.css',
    'resources/css/app.css',
    'resources/js/app.js'
])


</head>

<body>
<div class="login-page">
    <div class="page">

        <div class="card">

            {{ $slot }}

        </div>

    </div>
 </div>
</body>

</html>
