<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin ORCA</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="login-wrapper">

    <div class="login-card">

        <!-- HEADER -->
        <div class="login-header">
            <div>
                <h1>Login Admin</h1>
                <p>Silakan login untuk masuk ke dashboard admin.</p>
            </div>
        </div>

        <div class="login-body">

            <!-- ILUSTRASI -->
            <div class="login-image">
                <img src="{{ asset('images/logadmin.png') }}">
            </div>

            <!-- FORM -->
            <div class="login-form">

                {{-- STATUS LOGIN --}}
                @if (session('status'))
                    <p>{{ session('status') }}</p>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="login-input"
                               required autofocus>

                        @error('email')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password"
                               name="password"
                               class="login-input"
                               required>

                        @error('password')
                            <small>{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- REMEMBER ME -->
                    <div class="form-group" style="display:flex;align-items:center;gap:8px;">
                        <input type="checkbox"
                               name="remember"
                               id="remember">
                        <label for="remember">Remember Me</label>
                    </div>

                    <!-- EXTRA LINK -->
                    <div class="login-extra">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <!-- BUTTON LOGIN -->
                    <button type="submit" class="login-btn">
                        Login
                    </button>

                </form>

                <!-- KEMBALI BERANDA -->
                <div style="text-align:center;margin-top:15px;">
                    <a href="{{ route('home') ?? '/' }}"
                       style="text-decoration:none;color:#64748b;">
                       ← Kembali ke Beranda
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
