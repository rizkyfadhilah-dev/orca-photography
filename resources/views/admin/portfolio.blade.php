@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Kelola Portofolio</h1>

{{-- UPLOAD --}}
<form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data"
      class="mb-8 bg-white p-6 rounded-xl shadow">
    @csrf
    <input type="file" name="gambar" required>
    <button class="ml-4 px-4 py-2 bg-blue-600 text-white rounded">
        Upload
    </button>
</form>

{{-- LIST --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
@foreach($portfolios as $item)
    <div class="bg-white p-4 rounded-xl shadow text-center">
        <img src="{{ asset('storage/'.$item->gambar) }}"
             class="rounded-lg mb-3 h-40 w-full object-cover">

        {{-- GANTI FOTO --}}
        <form action="{{ route('admin.portfolio.update', $item->id) }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="file" name="gambar" required class="text-sm mb-2">
            <button class="w-full bg-yellow-500 text-white py-1 rounded mb-2">
                Ganti
            </button>
        </form>

        {{-- HAPUS --}}
        <form action="{{ route('admin.portfolio.delete', $item->id) }}"
              method="POST">
            @csrf
            @method('DELETE')
            <button class="w-full bg-red-600 text-white py-1 rounded">
                Hapus
            </button>
        </form>
    </div>
@endforeach
</div>
@endsection
