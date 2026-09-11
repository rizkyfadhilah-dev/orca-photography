@extends('admin.layout')

@section('content')
<h1>Data Booking</h1>

<a href="{{ route('admin.bookings.create') }}" class="btn">
    + Tambah Booking
</a>

{{-- FORM SEARCH --}}
<form method="GET" action="{{ route('jadwal') }}" style="margin-top:15px;">
    <input type="text" name="search"
           placeholder="Cari booking..."
           value="{{ request('search') }}">
    <button type="submit">Search</button>
</form>

<table style="width:100%; margin-top:20px;">
    <tr>
        <th>Nama</th>
        <th>No HP</th>
        <th>Layanan</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($bookings as $b)
    <tr>
        <td>{{ $b->nama }}</td>
        <td>{{ $b->no_hp }}</td>
        <td>{{ $b->kategori }}</td>
        <td>{{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}</td>
        <td>{{ $b->status }}</td>
        <td>
            <form method="POST" action="{{ route('jadwal.delete', $b->id) }}">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus booking ini?')">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
