@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Tambah Layanan Fotografi
</h2>

<form action="{{ route('admin.services.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-4">

    @csrf

    <input type="text" name="nama"
           placeholder="Nama layanan"
           class="border p-3 w-full rounded"
           required>

    <textarea name="deskripsi"
              placeholder="Deskripsi layanan"
              class="border p-3 w-full rounded"
              required></textarea>

    <input type="file" name="icon"
           class="border p-3 w-full rounded"
           required>

    <button class="bg-blue-600 text-white px-6 py-3 rounded">
        Simpan
    </button>

</form>

@endsection
