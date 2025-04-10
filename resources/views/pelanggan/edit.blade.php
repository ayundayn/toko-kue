@extends('layouts.app')

@section('content')
@include('sweetalert::alert')

<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Edit Pelanggan</h2>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_pelanggan" class="block text-gray-700">Nama Pelanggan</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                   value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 @error('nama_pelanggan') border-red-500 @enderror">
            @error('nama_pelanggan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telepon" class="block text-gray-700">No Telepon</label>
            <input type="number" id="telepon" name="telepon"
                   value="{{ old('telepon', $pelanggan->telepon) }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 @error('telepon') border-red-500 @enderror">
            @error('telepon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-gray-700">Alamat</label>
            <textarea id="alamat" name="alamat"
                      class="w-full border border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200 @error('alamat') border-red-500 @enderror">{{ old('alamat', $pelanggan->alamat) }}</textarea>
            @error('alamat')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>

        <a href="{{ route('pelanggan.index') }}" class="ml-2 text-gray-600 hover:text-gray-900">Batal</a>
    </form>
</div>
@endsection
