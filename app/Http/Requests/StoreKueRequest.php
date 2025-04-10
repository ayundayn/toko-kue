<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKueRequest extends FormRequest {

    public function rules(): array {
        return [
            'nama_kue' => 'required|string|max:255',
            'harga' => 'required|numeric|min:1',
            'stok' => 'required|numeric|min:1',
            'kategori_id' => 'required|exists:kategori,id',
        ];
    }

    public function messages(): array {
        return [
            'nama_kue.required' => 'Nama kue harus diisi!',
            'harga.required' => 'Harga harus diisi!',
            'harga.numeric' => 'Harga harus berupa angka!',
            'harga.min' => 'Harga minimal 1!',
            'stok.required' => 'Stok harus diisi!',
            'stok.integer' => 'Stok harus berupa angka!',
            'stok.min' => 'Stok minimal 1!',
            'kategori_id.required' => 'Kategori harus dipilih!',
            'kategori_id.exists' => 'Kategori tidak valid!',
        ];
    }
}