<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKategoriRequest extends FormRequest {
    
    public function rules(): array {
        return [
            'nama_kategori' => 'required',
        ];
    }

    public function messages(): array {
        return [
            'nama_kategori.required' => 'Nama Kategori tidak boleh kosong',
        ];
    }
}