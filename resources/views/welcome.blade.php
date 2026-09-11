<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Fotografer</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header class="navbar">
    <div class="logo">
    <img src="{{ asset('images/logo2.png') }}" alt="ORCA Photography">
    </div>
    <nav>
        <a href="/">Beranda</a>
        <a href="#layanan">Layanan</a>
        <a href="#portfolio">Portofolio</a>
        <a href="#cara-order">Cara Order</a>
        <a href="{{ route('jadwal') }}">Jadwal Booking</a>

        @auth
            <a href="{{ route('admin.dashboard') }}" class="btn">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn">Login Admin</a>
        @endauth
    </nav>
</header>
<div class="navbar-line"></div>

<!-- ================= HERO ================= -->
<section class="hero">
    <div class="hero-image">
        <img src="{{ asset('images/tampilan awal.png') }}" alt="Fotografer">
    </div>

    <div class="hero-text">
        <h1>Abadikan Setiap<br>Momen Berharga</h1>
        <p>
            Setiap cerita layak diingat, dan kami hadir untuk menangkapnya dalam karya visual terbaik.
        </p>
        <a href="#portfolio" class="btn-primary">Portofolio Kami</a>
    </div>
</section>

<!-- LAYANAN KAMI -->
<section id="layanan" class="layanan">
    <h2>Layanan Kami</h2>
    <p class="layanan-desc">
        Berbagai layanan fotografi profesional sesuai kebutuhan Anda.
    </p>
        <div class="layanan-grid">

            @foreach($layanans as $layanan)
                <div class="layanan-card">

                    @if($layanan->icon)
                        <img src="{{ asset('storage/'.$layanan->icon) }}"
                            alt="{{ $layanan->nama }}">
                    @endif

                    <h3>{{ $layanan->nama }}</h3>
                    <p>{{ $layanan->deskripsi }}</p>

                </div>
            @endforeach

        </div>
</section>

<!-- ================= PORTFOLIO ================= -->
<section id="portfolio" class="portfolio">
    <h2>Portofolio Kami</h2>
    <p class="portfolio-desc">
        Beberapa hasil karya kami.
    </p>

    <div class="portfolio-grid">
        @foreach($portfolios as $item)
            <div class="portfolio-item">
                <img src="{{ asset('storage/'.$item->gambar) }}"
                     alt="Portofolio">
            </div>
        @endforeach
    </div>
</section>

<!-- CARA ORDER -->
<section id="cara-order" class="cara-order">
    <div class="cara-order-container">

        <!-- ILUSTRASI -->
        <div class="cara-order-image">
            <img src="{{ asset('images/cara order.jpeg') }}" alt="Cara Order Booking">
        </div>

        <!-- LANGKAH -->
        <div class="cara-order-content">
            <h2>Cara Order Layanan Kami?</h2>

            <ul class="cara-order-steps">
                <li>
                    <span>1</span>
                    <p>Masukan Nomor Handphone/WhatsApp</p>
                </li>
                <li>
                    <span>2</span>
                    <p>Masukan Nama Lengkap</p>
                </li>
                <li>
                    <span>3</span>
                    <p>Pilih Layanan Yang Diinginkan</p>
                </li>
                <li>
                    <span>4</span>
                    <p>Tentukan jadwal booking (Cek Jadwal Bookng dulu!)</p>
                </li>
                <li>
                    <span>5</span>
                    <p>Konfirmasi Via WhatsApp</p>
                </li>
            </ul>
<a href="#booking-form" class="btn-booking">
    Booking Sekarang
</a>
        </div>

    </div>
</section>

<!-- ================= BOOKING ================= -->
<section id="booking-form" class="booking-section">
    <div class="booking-box">
        <h1>Booking Jasa Fotografi</h1>

        <form method="POST" action="{{ route('booking.store') }}" class="booking-form">
            @csrf

            <input type="text" name="no_hp"
                placeholder="Nomor HP / WhatsApp"
                required>
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <select name="kategori" required>
                <option value="">Pilih Layanan</option>
                <option value="Wedding">Wedding</option>
                <option value="Prewedding">Prewedding</option>
                <option value="Produk UMKM">Produk</option>
                <option value="Event">Event</option>
                <option value="Lainnya">Lainnya</option>
            </select>

            <input type="date" name="tanggal" id="tanggal" required>

            <button type="submit">
                Konfirmasi Booking
            </button>
        </form>
    </div>
</section>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tanggalInput = document.getElementById('tanggal');

    // Disable tanggal sebelum hari ini
    const today = new Date().toISOString().split('T')[0];
    tanggalInput.setAttribute('min', today);

    // Ambil tanggal yang sudah dibooking
    fetch('/api/booked-dates')
        .then(res => res.json())
        .then(bookedDates => {
            tanggalInput.addEventListener('change', function () {
                if (bookedDates.includes(this.value)) {
                    alert('Tanggal ini sudah dibooking. Pilih tanggal lain.');
                    this.value = '';
                }
            });
        });
});
</script>

<!-- ================= FOOTER ================= -->
<footer class="footer-glass">

    <div class="footer-content">

        <!-- BRAND -->
        <div class="footer-left">
            <h2>ORCA PHOTOGRAPHY</h2>
            <p>
                Ada kendala, pertanyaan, atau butuh informasi lebih?
                Jangan ragu untuk menghubungi kami, kami siap membantu Anda kapan saja.
            </p>

            <div class="footer-social">
<a href="https://www.instagram.com/orca.photographyy?igsh=OW93NzhxZ3o5bTRr"
   target="_blank">
   Instagram
</a>
<a href="https://wa.me/6283146113373"
   target="_blank">
   WhatsApp
</a>

            </div>
        </div>


        <!-- NAVIGASI -->
        <div class="footer-nav">
            <h4>Navigasi</h4>
            <a href="/">Beranda</a>
            <a href="#layanan">Layanan</a>
            <a href="#portfolio">Portofolio</a>
            <a href="#cara-order">Cara Order</a>
            <a href="{{ route('jadwal') }}">Jadwal Booking</a>
        </div>


        <!-- KONTAK -->
        <div class="footer-right">
            <h4>Contact</h4>
            <p>📍 Kulon Progo, Yogyakarta</p>
            <p>📞 0888-0329-6455</p>
            <p>✉ orcaphotoggraphyy@gmail.com</p>
        </div>

    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} ORCA Photography
    </div>

</footer>

</body>
</html>
