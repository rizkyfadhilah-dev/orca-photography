@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<h1 class="text-3xl font-bold mb-10 text-slate-800">
    Dashboard Admin
</h1>

{{-- STAT CARD --}}
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">

    {{-- TOTAL BOOKING --}}
    <div class="bg-white rounded-2xl shadow p-6 text-center">
        <img src="{{ asset('images/jumlah all.png') }}"
             class="mx-auto h-20 mb-4">
        <p class="text-gray-500">Total Booking</p>
        <p class="text-4xl font-bold text-blue-600 mt-2">
            {{ \App\Models\Booking::count() }}
        </p>
    </div>

    {{-- BOOKING HARI INI --}}
    <div class="bg-white rounded-2xl shadow p-6 text-center">
        <img src="{{ asset('images/admin jumlah boking.png') }}"
             class="mx-auto h-20 mb-4">
        <p class="text-gray-500">Booking Hari Ini</p>
    <p class="text-4xl font-bold mt-2 text-blue-600">
{{ 
    \App\Models\Booking::whereDate('created_at', today())
    ->count()
}}
</p>

    </div>
    {{-- STATUS --}}
    <div class="bg-white rounded-2xl shadow p-6 text-center">
        <img src="{{ asset('images/status admin.png') }}"
             class="mx-auto h-20 mb-4">
        <p class="text-gray-500">Status</p>
        <p class="text-xl font-bold text-green-600 mt-2">
            Admin Aktif
        </p>
    </div>

    {{-- MANAGE BOOKING --}}
    <div class="bg-white rounded-2xl shadow p-6 text-center">
        <img src="{{ asset('images/kelola admin.png') }}"
             class="mx-auto h-20 mb-4
             hover:bg-blue-700 text-white rounded-xl font-semibold transition">
        <p class="font-semibold mb-4">Manage Booking</p>

        {{-- 🔧 TOMBOL DIPERBAIKI --}}
        <a href="{{ route('jadwal') }}"
           class="inline-block px-6 py-3 bg-blue-600
                  hover:bg-blue-700 text-white rounded-xl font-semibold transition">
            Kelola Status Booking
        </a>
    </div>

</div>

@endsection
