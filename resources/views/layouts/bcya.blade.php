<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Bor Community Youth Association')</title>

    @vite(['resources/css/bcya.css', 'resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="@yield('page-class')">
        <div class="navbar">

            <div class="brand">

                BCYA

            </div>

            <div class="nav-links">

                @yield('navbar')

            </div>

        </div>

        @yield('content')

        <footer>

            © {{ date('Y') }} Bor Community Youth Association (BCYA). All Rights Reserved.

        </footer>
    </div>
</body>

</html>
