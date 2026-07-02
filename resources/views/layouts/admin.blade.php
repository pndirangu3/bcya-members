<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BCYA Administrator')</title>

    @vite(['resources/css/bcya.css', 'resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <div class="admin-page">

        <header class="admin-header">

            <div class="admin-logo">

                <img src="{{ asset('images/bcya-logo.jpg') }}" alt="BCYA Logo">

                <div>

                    <h2>BCYA Administrator</h2>

                    <small>Membership Management System</small>

                </div>

            </div>

            <div class="admin-user">

                <span>

                    Welcome,

                    <strong>{{ Auth::user()->name }}</strong>

                </span>

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button class="logout-btn">

                        Logout

                    </button>

                </form>

            </div>

        </header>

        <div class="admin-body">

            <aside class="admin-sidebar">

                <nav>

                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <span>🏠</span>
                        Dashboard
                    </a>

                    <a href="{{ route('members.index') }}"
                        class="{{ request()->routeIs('members.index') ? 'active' : '' }}">
                        <span>👥</span>
                        Members
                    </a>

                    <a href="{{ route('members.create') }}"
                        class="{{ request()->routeIs('members.create') ? 'active' : '' }}">
                        <span>➕</span>
                        Register Member
                    </a>

                    <a href="#">
                        <span>⏳</span>
                        Pending Approval
                    </a>

                    <a href="#">
                        <span>📍</span>
                        Payams
                    </a>

                    <a href="#">
                        <span>📍</span>
                        Bomas
                    </a>

                    <a href="#">
                        <span>👤</span>
                        Users
                    </a>

                    <a href="#">
                        <span>📊</span>
                        Reports
                    </a>

                    <a href="#">
                        <span>⚙️</span>
                        Settings
                    </a>

                </nav>

            </aside>

            <main class="admin-content">

                @yield('content')

            </main>

        </div>

    </div>

</body>

</html>
