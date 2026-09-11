@extends('admin.layout')

@section('content')
<h1>Tambah Booking</h1>

<form method="POST" action="{{ route('admin.bookings.store') }}">
    @csrf

    <input type="text" name="nama" placeholder="Nama Pemesan" required>
    <br><br>

    <select name="kategori" required>
        <option value="">Pilih Layanan</option>
        <option>Wedding</option>
        <option>Prewedding</option>
        <option>Produk UMKM</option>
        <option>Event</option>
        <option>Lainnya</option>
    </select>
    <br><br>

    <input type="date" name="tanggal" required>
    <br><br>

    <button type="submit" class="btn-primary">Simpan</button>
</form>
@endsection
