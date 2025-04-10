@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Daftar Pelanggan</h2>

    <!-- Tombol Tambah Pelanggan -->
    <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
        + Tambah Pelanggan
    </a>

    <!-- Tabel -->
    <div class="mt-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Pelanggan</th>
                    <th class="border border-gray-300 px-4 py-2">No Telepon</th>
                    <th class="border border-gray-300 px-4 py-2">Alamat</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th> <!-- Tambah kolom aksi -->
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggans as $index => $item)
                <tr class="text-center">
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-start">{{ $item->nama_pelanggan }}</td>
                    <td class="border border-gray-300 px-4 py-2t">{{ $item->telepon }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-start">{{ $item->alamat }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">
                        <div class="inline-flex space-x-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('pelanggan.edit', $item->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
