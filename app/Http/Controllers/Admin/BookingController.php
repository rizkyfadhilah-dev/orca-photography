<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        // Jika bukan admin → hanya tampilkan booked
        if (!auth()->check()) {
            $query->where('status', 'booked');
        }

        // SEARCH BOOKING
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('kategori', 'like', '%' . $request->search . '%')
                  ->orWhere('no_hp', 'like', '%' . $request->search . '%')
                  ->orWhere('tanggal', 'like', '%' . $request->search . '%')
                  ->orWhere('status', 'like', '%' . $request->search . '%');
            });
        }

        $bookings = $query->orderBy('tanggal')->get();

        return view('jadwal', compact('bookings'));
    }

    public function create()
    {
        return view('admin.bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
            'tanggal' => 'required|date',
            'no_hp' => 'required'
        ]);

        Booking::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'no_hp' => $request->no_hp,
            'status' => 'booked',
        ]);

        return redirect()->route('jadwal');
    }

    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();
        return back();
    }
}
