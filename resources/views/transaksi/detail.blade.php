@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mt-8 text-sm font-mono">
    <div class="text-center border-b pb-2 mb-2">
        <p class="font-bold">Nama Pelanggan: {{ optional($transaksi->pelanggan)->nama_pelanggan ?? '-' }}</p>
        <p>{{ $transaksi->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="border-b">
                <th class="text-left">Nama Kue</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @if($transaksi->detailTransaksi && $transaksi->detailTransaksi->isNotEmpty())
                @foreach($transaksi->detailTransaksi as $detail)
                    <tr>
                        <td class="border-t">{{ optional($detail->kue)->nama_kue ?? '-' }}</td>
                        <td class="border-t text-center">{{ $detail->jumlah_kue ?? '-' }}</td>
                        <td class="border-t text-right">Rp {{ number_format($detail->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center text-gray-500 border-t">Detail transaksi tidak tersedia</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="flex justify-between border-t mt-2 pt-2 font-bold">
        <p>Bayar: {{ $transaksi->metode_bayar }}</p>
        <p>Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('transaksi.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-300">Kembali</a>
    </div>
</div>
@endsection
