@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Kelola Portofolio</h2>

<a href="{{ route('admin.portfolio.create') }}"
   class="inline-block mb-6 px-5 py-3 bg-blue-600 text-white rounded-lg">
   + Tambah Portofolio
</a>

<div class="grid grid-cols-4 gap-6">
@foreach ($portfolios as $item)
    <div class="bg-white p-4 rounded-xl shadow">
        <img src="{{ asset('storage/'.$item->gambar) }}"
             class="rounded-lg mb-4">

        <div class="flex gap-2">
            <a href="{{ route('admin.portfolio.edit', $item) }}"
               class="px-3 py-1 bg-yellow-500 text-white rounded">
               Edit
            </a>

            <form action="{{ route('admin.portfolio.destroy', $item) }}"
                  method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus?')"
                        class="px-3 py-1 bg-red-600 text-white rounded">
                    Hapus
                </button>
            </form>
        </div>
    </div>
@endforeach
</div>
@endsection
