@extends('layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">
Edit Layanan Fotografi
</h2>

<form action="{{ route('admin.services.update', $service) }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-4">

    @csrf
    @method('PUT')

    <input type="text" name="nama"
           value="{{ $service->nama }}"
           class="border p-3 w-full rounded"
           required>

    <textarea name="deskripsi"
              class="border p-3 w-full rounded"
              required>{{ $service->deskripsi }}</textarea>

    <input type="file" name="icon"
           class="border p-3 w-full rounded">

    @if($service->icon)
        <img src="{{ asset('storage/'.$service->icon) }}"
             width="120">
    @endif

    <button class="bg-blue-600 text-white px-6 py-3 rounded">
        Update
    </button>

</form>

@endsection
