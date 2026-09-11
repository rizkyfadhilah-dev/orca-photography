<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Booking</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<section class="jadwal-section">
    <div class="jadwal-container">

        <h1 class="jadwal-title">Jadwal Booking</h1>
        <form method="GET" action="{{ route('jadwal') }}" style="margin-bottom:20px;">
    <input type="text" name="search"
           placeholder="Cari nama / layanan / tanggal..."
           value="{{ request('search') }}"
           style="padding:8px; width:250px;">
    
    <button type="submit" style="padding:8px 15px;">
        Cari
    </button>
</form>


        <table class="jadwal-table">
            <thead>
                <tr>
                    <th>No HP</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Layanan</th>
                    <th>Status</th>

                    @auth
                        <th>Aksi</th>
                    @endauth
                </tr>
            </thead>

            <tbody>
                @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $booking->no_hp }}</td>
                    <td>{{ $booking->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}</td>
                    <td>{{ $booking->kategori }}</td>
                    <td>
                        <span class="status {{ $booking->status }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>

                    @auth
                    <td class="aksi">
                        <!-- UPDATE STATUS -->
                        <form method="POST" action="{{ route('jadwal.updateStatus', $booking) }}">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="select-status">
                                <option value="pending" {{ $booking->status=='pending'?'selected':'' }}>
                                    Pending
                                </option>
                                <option value="booked" {{ $booking->status=='booked'?'selected':'' }}>
                                    Booked
                                </option>
                            </select>
                        </form>

                        <!-- HAPUS -->
                        <form method="POST" action="{{ route('jadwal.delete', $booking) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn-hapus"
                                onclick="return confirm('Hapus booking ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                    @endauth
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="empty">
                        Belum ada jadwal booking
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="jadwal-back">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="btn-back">
                    ← Kembali ke Dashboard
                </a>
            @else
                <a href="{{ route('home') }}" class="btn-back">
                    ← Kembali ke Beranda
                </a>
            @endauth
        </div>

    </div>
</section>

</body>
</html>
