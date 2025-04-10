@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Tambah Pelanggan</h2>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300 @error('nama_pelanggan') border-red-500 @enderror"
                value="{{ old('nama_pelanggan') }}">
            @error('nama_pelanggan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telepon" class="block text-sm font-medium text-gray-700">No Telepon</label>
            <input type="number" id="telepon" name="telepon"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300 @error('telepon') border-red-500 @enderror"
                value="{{ old('telepon') }}">
            @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <textarea id="alamat" name="alamat"
                class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-300 @error('alamat') border-red-500 @enderror"
                >{{ old('alamat') }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('pelanggan.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                Kembali
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
