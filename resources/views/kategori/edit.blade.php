@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Edit Kategori</h2>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_kategori" class="block text-gray-700">Nama Kategori</label>
            <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                   class="w-full border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
            @error('nama_kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>

        <a href="{{ route('kategori.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Batal</a>
    </form>
</div>
@endsection
