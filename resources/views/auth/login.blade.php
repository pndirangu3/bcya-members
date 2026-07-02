<x-guest-layout>

    <x-auth-session-status :status="session('status')" />

    <img src="{{ asset('images/bcya-logo.jpg') }}" alt="BCYA Logo" class="logo">

    <h1>Administrator Portal</h1>

    <p class="subtitle">
        Bor Community Youth Association
    </p>

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <div class="form-group">

            <label>Email Address</label>

            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            <x-input-error :messages="$errors->get('email')" />

        </div>

        <div class="form-group">

            <label>Password</label>

            <input id="password" type="password" name="password" required>

            <x-input-error :messages="$errors->get('password')" />

        </div>



        <button type="submit" class="btn-login">

            Log In

        </button>

        <div class="options">

            <label>

                <input id="remember_me" type="checkbox" name="remember">

                Remember me

            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">

                    Forgot Password?

                </a>
            @endif

        </div>

    </form>

    <div class="footer">

        © {{ date('Y') }} Bor Community Youth Association

    </div>

</x-guest-layout>
