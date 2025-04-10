@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Tambah Kategori</h2>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300 @error('nama_kategori') border-red-500 @enderror"
                value="{{ old('nama_kategori') }}">
            @error('nama_kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-between">
            <a href="{{ route('kategori.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
