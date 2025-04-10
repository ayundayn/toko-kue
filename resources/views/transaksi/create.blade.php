@extends('layouts.app')

@section('content')

@include('sweetalert::alert')

<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8">
    <h2 class="text-xl font-bold mb-4">Tambah Transaksi</h2>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Silakan periksa kembali form Anda!',
            });
        </script>
    @endif

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <!-- Pilih Pelanggan -->
        <div class="mb-4">
            <label for="pelanggan" class="block text-sm font-medium text-gray-700">Pelanggan</label>
            <select name="pelanggan_id" id="pelanggan" class="w-full border border-gray-300 rounded-md p-2">
                <option value="">Pilih Pelanggan</option>
                @foreach($pelanggans as $pelanggan)
                    <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
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
            <div class="mb-4 flex space-x-2 kue-row">
                <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700">Kue</label>
                    <select name="kue_id[]" class="kue-select w-full border border-gray-300 rounded-md p-2">
                        <option value="">Pilih Kue</option>
                        @foreach($kues as $kue)
                            <option value="{{ $kue->id }}" data-harga="{{ $kue->harga }}" data-stok="{{ $kue->stok }}">
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
                    <input type="number" name="jumlah_kue[]" class="jumlah-input w-full border border-gray-300 rounded-md p-2" min="1" step="1" value="1">
                    @error('jumlah_kue.*')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="button" class="remove-kue bg-red-500 text-white px-3 py-2 rounded-md hover:bg-red-700 mt-auto" disabled>
                    🗑️
                </button>
            </div>
        </div>

        <button type="button" id="add-kue" class="bg-green-500 text-white px-3 py-2 rounded-md hover:bg-green-700 mb-4">
            + Tambah Kue
        </button>

        <!-- Total Harga -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Total Harga</label>
            <input type="text" id="total_harga_display" class="w-full border border-gray-300 rounded-md p-2 bg-gray-100" readonly>
            <input type="hidden" name="total_harga" id="total_harga">
        </div>

        <!-- Metode Pembayaran -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
            <select name="metode_bayar" class="w-full border border-gray-300 rounded-md p-2">
                <option value="Cash">Cash</option>
                <option value="Transfer">Transfer</option>
            </select>
            @error('metode_bayar')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between">
            <a href="{{ route('transaksi.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
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

        function updateRemoveButtons() {
            document.querySelectorAll(".remove-kue").forEach((button, index) => {
                button.disabled = (document.querySelectorAll(".kue-row").length === 1);
            });
        }

        function addKueRow() {
            const newRow = document.createElement("div");
            newRow.classList.add("mb-4", "flex", "space-x-2", "kue-row");
            newRow.innerHTML = kueContainer.firstElementChild.innerHTML;
            kueContainer.appendChild(newRow);
            newRow.querySelector(".kue-select").addEventListener("change", updateTotalHarga);
            newRow.querySelector(".jumlah-input").addEventListener("input", updateTotalHarga);
            newRow.querySelector(".remove-kue").addEventListener("click", function () {
                newRow.remove();
                updateTotalHarga();
                updateRemoveButtons();
            });
            updateTotalHarga();
            updateRemoveButtons();
        }

        addKueBtn.addEventListener("click", addKueRow);
        document.querySelectorAll(".kue-select, .jumlah-input").forEach(input => {
            input.addEventListener("input", updateTotalHarga);
        });
        updateTotalHarga();
        updateRemoveButtons();
    });
</script>
@endsection
