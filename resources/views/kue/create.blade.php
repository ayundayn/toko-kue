@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Tambah Kue</h2>
    
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('kue.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_kue" class="block text-sm font-medium text-gray-700">Nama Kue</label>
            <input type="text" id="nama_kue" name="nama_kue" value="{{ old('nama_kue') }}" 
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('nama_kue')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" id="harga" name="harga" value="{{ old('harga') }}" min="1" 
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('harga')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok') }}" min="1" 
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
            @error('stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="kategori_id" id="kategori" 
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
