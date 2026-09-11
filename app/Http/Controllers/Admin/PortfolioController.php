<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolio.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $path = $request->file('gambar')->store('portfolio', 'public');

        Portfolio::create([
            'gambar' => $path
        ]);

        return redirect()->route('admin.portfolio.index')
                         ->with('success', 'Portofolio berhasil ditambahkan');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($portfolio->gambar);
            $portfolio->gambar = $request->file('gambar')->store('portfolio', 'public');
        }

        $portfolio->save();

        return redirect()->route('admin.portfolio.index')
                         ->with('success', 'Portofolio berhasil diperbarui');
    }

    public function destroy(Portfolio $portfolio)
    {
        Storage::disk('public')->delete($portfolio->gambar);
        $portfolio->delete();

        return back()->with('success', 'Portofolio berhasil dihapus');
    }
}
