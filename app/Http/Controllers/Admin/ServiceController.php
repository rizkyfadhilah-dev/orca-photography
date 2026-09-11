<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'icon' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('icon')) {
            $path = $request->file('icon')->store('services', 'public');
        }

        Service::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'icon' => $path
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'icon' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('icon')) {
            if ($service->icon) {
                Storage::disk('public')->delete($service->icon);
            }
            $service->icon = $request->file('icon')->store('services', 'public');
        }

        $service->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'icon' => $service->icon
        ]);

        return redirect()->route('admin.services')->with('success', 'Layanan berhasil diupdate');
    }

    public function destroy(Service $service)
    {
        if ($service->icon) {
            Storage::disk('public')->delete($service->icon);
        }

        $service->delete();
        return back()->with('success', 'Layanan dihapus');
    }
}
