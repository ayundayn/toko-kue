<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailTransaksiRequest extends FormRequest {

    public function rules(): array {
        return [
            'transaksi_id' => 'required|exists:transaksi,id',
            'kue_id' => 'required|exists:kue,id',
            'jumlah_kue' => 'required|numeric|min:1',
            'total_harga_id' => 'required|numeric|min:1',
        ];
    }

    public function messages(): array {
        return [
            'transaksi_id.required' => 'Transaksi tidak boleh kosong',
            'kue_id.required' => 'Kue tidak boleh kosong',
            'jumlah_kue.required' => 'Jumlah kue tidak boleh kosong',
            'total_harga_id.required' => 'Total harga tidak boleh kosong',
        ];
    }
}