@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Kelola Layanan
</h1>

<a href="{{ route('admin.services.create') }}"
   class="bg-blue-600 hover:bg-blue-700
          text-white px-6 py-2 rounded-lg mb-6 inline-block">
+ Tambah Layanan
</a>

<div class="bg-white shadow rounded-xl p-6">

<table class="w-full text-left border-collapse">

<thead>
<tr class="border-b">
    <th class="p-3">Gambar</th>
    <th class="p-3">Nama</th>
    <th class="p-3">Deskripsi</th>
    <th class="p-3">Aksi</th>
</tr>
</thead>

<tbody>
@forelse($services as $service)
<tr class="border-b hover:bg-gray-50">

<td class="p-3">
@if($service->icon)
<img src="{{ asset('storage/'.$service->icon) }}"
     class="w-20 h-20 object-cover rounded-lg">
@else
<img src="{{ asset('images/default.png') }}"
     class="w-20 h-20 rounded-lg">
@endif
</td>

<td class="p-3 font-semibold">
    {{ $service->nama }}
</td>

<td class="p-3 text-gray-600">
    {{ $service->deskripsi }}
</td>

<td class="p-3">
    <div class="flex items-center gap-2">

        <!-- EDIT -->
        <a href="{{ route('admin.services.edit',$service->id) }}"
           class="bg-yellow-400 hover:bg-yellow-500
                  text-black px-4 py-1.5 rounded-lg
                  text-sm font-semibold transition">
            Edit
        </a>

        <!-- HAPUS -->
        <form action="{{ route('admin.services.destroy',$service->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin hapus layanan ini?')">

            @csrf
            @method('DELETE')

            <button class="bg-red-500 hover:bg-red-600
                           text-white px-4 py-1.5 rounded-lg
                           text-sm font-semibold transition">
                Hapus
            </button>

        </form>

    </div>
</td>

</tr>
@empty
<tr>
<td colspan="4" class="text-center p-4 text-gray-500">
Belum ada layanan
</td>
</tr>
@endforelse

</tbody>

</table>

</div>

@endsection
