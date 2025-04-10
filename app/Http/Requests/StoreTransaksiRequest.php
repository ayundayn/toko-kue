<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest {

    public function rules(): array {
        return [
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'total_harga' => 'required|numeric|min:1',
            'metode_bayar' => 'required|in:Cash,Transfer',
            'kue_id' => 'required|array',
            'kue_id.*' => 'exists:kue,id',
            'jumlah_kue' => 'required|array',
            'jumlah_kue.*' => 'integer|min:1',
        ];
    }
    
    public function messages(): array {
        return [
            'pelanggan_id.required' => 'Pelanggan harus dipilih!',
            'total_harga.required' => 'Total harga tidak boleh kosong!',
            'metode_bayar.required' => 'Pilih metode pembayaran!',
            'kue_id.required' => 'Pilih minimal satu kue!',
            'kue_id.*.exists' => 'Pilih minimal satu kue!',
            'jumlah_kue.required' => 'Masukkan jumlah kue!',
            'jumlah_kue.*.integer' => 'Jumlah kue harus berupa angka!',
            'jumlah_kue.*.min' => 'Minimal jumlah kue adalah 1!',
        ];
    }
    
}
