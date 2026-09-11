<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Portfolio;
use App\Http\Controllers\Admin\ServiceController;
use App\Models\Service;
use App\Http\Controllers\Admin\BookingController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

// HOME (dashboard user)
Route::get('/', function () {

    $layanans = Service::all(); // layanan dari DB
    $portfolios = Portfolio::latest()->take(8)->get();

    return view('welcome', compact('layanans', 'portfolios'));

})->name('home');


// HALAMAN JADWAL
Route::get('/jadwal', [BookingController::class, 'index'])
    ->name('jadwal');

// API tanggal booked
Route::get('/api/booked-dates', function () {
    return Booking::where('status', 'booked')->pluck('tanggal');
});

// SIMPAN BOOKING + redirect WA
Route::post('/booking', function (Request $request) {

    $request->validate([
        'nama' => 'required',
        'no_hp' => 'required',
        'kategori' => 'required',
        'tanggal' => 'required|date',
    ]);

    $booking = Booking::create([
        'nama' => $request->nama,
        'no_hp' => $request->no_hp,
        'kategori' => $request->kategori,
        'tanggal' => $request->tanggal,
        'status' => 'pending',
    ]);

    $pesan = "Halo Admin,
    Saya ingin booking jasa fotografi:

    Nama: {$booking->nama}
    No HP: {$booking->no_hp}
    Layanan: {$booking->kategori}
    Tanggal: {$booking->tanggal}

    Mohon konfirmasi. Terima kasih.";

    $nomorWA = "6283146113373"; // GANTI NOMOR WA
    return redirect()->away(
        "https://wa.me/".$nomorWA."?text=".urlencode($pesan)
    );

})->name('booking.store');

/*
|--------------------------------------------------------------------------
| AUTH (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ADMIN AREA (LOGIN WAJIB)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
    })->name('dashboard');

    // DASHBOARD
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // UPDATE STATUS BOOKING
    Route::post('/jadwal/{booking}/status', function (Booking $booking) {
        $booking->update([
            'status' => request('status')
        ]);
        return back();
    })->name('jadwal.updateStatus');

    // HAPUS BOOKING
    Route::delete('/jadwal/{booking}', function (Booking $booking) {
        $booking->delete();
        return back();
    })->name('jadwal.delete');

    // PORTOFOLIO ADMIN
    Route::get('/admin/portfolio', function () {
        $portfolios = Portfolio::all();
        return view('admin.portfolio', compact('portfolios'));
    })->name('admin.portfolio');

    // LIST PORTFOLIO
    Route::get('/admin/portfolio', function () {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolio', compact('portfolios'));
    })->name('admin.portfolio');

    // SIMPAN FOTO BARU
    Route::post('/admin/portfolio', function (Request $request) {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $path = $request->file('gambar')->store('portfolio', 'public');

        Portfolio::create([
            'gambar' => $path
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan');
    })->name('admin.portfolio.store');

    // UPDATE FOTO (REPLACE)
    Route::put('/admin/portfolio/{portfolio}', function (Request $request, Portfolio $portfolio) {
        $request->validate([
            'gambar' => 'required|image'
        ]);

        if (\Storage::disk('public')->exists($portfolio->gambar)) {
            \Storage::disk('public')->delete($portfolio->gambar);
        }

        $path = $request->file('gambar')->store('portfolio', 'public');
        $portfolio->update(['gambar' => $path]);

        return back()->with('success', 'Foto berhasil diperbarui');
    })->name('admin.portfolio.update');

    // HAPUS FOTO
    Route::delete('/admin/portfolio/{portfolio}', function (Portfolio $portfolio) {

        if (\Storage::disk('public')->exists($portfolio->gambar)) {
            \Storage::disk('public')->delete($portfolio->gambar);
        }

        $portfolio->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    })->name('admin.portfolio.delete');

    // Layanan/service
    Route::resource('admin/services', ServiceController::class)
        ->names([
            'index' => 'admin.services',
            'create' => 'admin.services.create',
            'store' => 'admin.services.store',
            'edit' => 'admin.services.edit',
            'update' => 'admin.services.update',
            'destroy' => 'admin.services.destroy'
        ]);

});
