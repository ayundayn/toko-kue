@extends('layouts.app')

@section('content')

@include('sweetalert::alert')

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Edit Transaksi</h2>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Pilih Pelanggan -->
        <div class="mb-4">
            <label for="pelanggan" class="block text-sm font-medium text-gray-700">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan" class="w-full border border-gray-300 rounded-md p-2">
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ $transaksi->pelanggan_id == $pelanggan->id ? 'selected' : '' }}>
                        {{ $pelanggan->nama_pelanggan }}
                    </option>
                @endforeach
            </select>
            @error('pelanggan_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pilih Kue & Jumlah Kue -->
        <div id="kue-container">
            @foreach($transaksi->detailTransaksi as $detail)
            <div class="mb-4 flex space-x-2 kue-row">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Kue</label>
                    <select name="kue_id[]" class="kue-select w-full border border-gray-300 rounded-md p-2">
                        <option value="">Pilih Kue</option>
                        @foreach($kues as $kue)
                            <option value="{{ $kue->id }}" data-harga="{{ $kue->harga }}" data-stok="{{ $kue->stok }}" {{ $detail->kue_id == $kue->id ? 'selected' : '' }}>
                                {{ $kue->nama_kue }} (Rp{{ number_format($kue->harga) }}) - Stok: {{ $kue->stok }}
                            </option>
                        @endforeach
                    </select>
                    @error('kue_id.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-1/3">
                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="jumlah_kue[]" class="jumlah-input w-full border border-gray-300 rounded-md p-2" min="1" step="1" value="{{ $detail->jumlah_kue }}">
                    @error('jumlah_kue.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="button" class="remove-kue bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-700 mt-auto">
                    🗑️
                </button>
            </div>
            @endforeach
        </div>

        <button type="button" id="add-kue" class="bg-green-500 text-white px-3 py-2 rounded-md hover:bg-green-700 mb-4">
            + Tambah Kue
        </button>

        <!-- Total Harga -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Total Harga</label>
            <input type="text" id="total_harga_display" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly value="Rp {{ number_format($transaksi->total_harga) }}">
            <input type="hidden" name="total_harga" id="total_harga" value="{{ $transaksi->total_harga }}">
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select name="metode_bayar" class="w-full border border-gray-300 rounded-md p-2">
                <option value="Cash" {{ $transaksi->metode_bayar == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="Transfer" {{ $transaksi->metode_bayar == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
            
            @error('metode_bayar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('transaksi.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const kueContainer = document.getElementById("kue-container");
        const addKueBtn = document.getElementById("add-kue");
        const totalHargaDisplay = document.getElementById("total_harga_display");
        const totalHargaInput = document.getElementById("total_harga");

        function updateTotalHarga() {
            let total = 0;
            document.querySelectorAll(".kue-row").forEach(row => {
                const kueSelect = row.querySelector(".kue-select");
                const jumlahInput = row.querySelector(".jumlah-input");
                const harga = parseInt(kueSelect.options[kueSelect.selectedIndex]?.getAttribute("data-harga")) || 0;
                const jumlah = parseInt(jumlahInput.value) || 1;
                total += harga * jumlah;
            });
            totalHargaDisplay.value = 'Rp ' + total.toLocaleString("id-ID");
            totalHargaInput.value = total;
        }

        addKueBtn.addEventListener("click", function () {
            const newRow = kueContainer.firstElementChild.cloneNode(true);
            newRow.querySelector(".jumlah-input").value = 1;
            newRow.querySelector(".kue-select").selectedIndex = 0;

            // Tambahkan event listener baru untuk input jumlah
            newRow.querySelector(".jumlah-input").addEventListener("input", updateTotalHarga);
            newRow.querySelector(".kue-select").addEventListener("change", updateTotalHarga);

            kueContainer.appendChild(newRow);
        });

        // Gunakan event delegation untuk tombol hapus
        kueContainer.addEventListener("click", function (event) {
            if (event.target.classList.contains("remove-kue")) {
                event.target.closest(".kue-row").remove();
                updateTotalHarga();
            }
        });

        // Tambahkan event listener pada elemen yang sudah ada
        document.querySelectorAll(".kue-select, .jumlah-input").forEach(input => {
            input.addEventListener("input", updateTotalHarga);
        });

        updateTotalHarga();
    });
</script>
@endsection
