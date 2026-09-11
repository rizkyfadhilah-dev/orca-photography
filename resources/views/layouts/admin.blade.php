<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-blue-700 text-white p-6">
       <div class="w-24 h-24 mx-auto rounded-full bg-white
            flex items-center justify-center shadow-md overflow-hidden">
    <img src="{{ asset('images/logo.jpg') }}"
         alt="ORCA Photography"
         class="w-16 h-16 object-contain">
</div>

        <nav class="space-y-4">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg bg-blue-600">
                Dashboard
            </a>

            <a href="{{ route('jadwal') }}"
               class="block px-4 py-2 rounded-lg hover:bg-blue-600">
                Kelola Status Booking
            </a>

            {{--<a href="{{ route('home') }}"
               class="block px-4 py-2 rounded-lg hover:bg-blue-600">
                Lihat Website
            </a>--}}

            <a href="{{ route('admin.services') }}"
            class="block px-4 py-2 rounded-lg hover:bg-blue-600">
            Kelola Layanan
            </a>
        
        <a href="{{ route('admin.portfolio') }}"
            class="block px-4 py-2 rounded-lg hover:bg-blue-600">
             Kelola Portofolio
        </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full text-left px-4 py-2 rounded-lg text-red-200 hover:bg-red-600 mt-6">
                    Keluar
                </button>
            </form>
        </nav>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 p-10">
        @yield('content')
    </main>

</div>

</body>
</html>
