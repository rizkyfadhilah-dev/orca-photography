<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="navbar">
    <div class="logo">ADMIN PANEL</div>

    <nav>
        <a href="{{ url('/') }}">Website</a>

        {{-- Dashboard admin --}}
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>

        {{-- Kelola booking (SATU HALAMAN DENGAN USER) --}}
        <a href="{{ route('jadwal') }}">Jadwal Booking</a>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn">Logout</button>
        </form>
    </nav>
</header>

<main style="max-width:1200px; margin:auto; padding:60px 20px;">
    @yield('content')
</main>

</body>
</html>
