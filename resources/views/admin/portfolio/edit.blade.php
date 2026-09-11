@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Portofolio</h2>

<form action="{{ route('admin.portfolio.update', $portfolio) }}"
      method="POST" enctype="multipart/form-data"
      class="bg-white p-6 rounded-xl shadow w-96">

    @csrf
    @method('PUT')

    <img src="{{ asset('storage/'.$portfolio->gambar) }}"
         class="mb-4 rounded">

    <input type="file" name="gambar" class="mb-4">

    <button class="px-6 py-3 bg-blue-600 text-white rounded-lg">
        Update
    </button>
</form>
@endsection
