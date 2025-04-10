<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePelangganRequest extends FormRequest {

    public function rules(): array
    {
        return [
            'nama_pelanggan' => 'required|string|max:255',
            'telepon' => [
                'required',
                'numeric',
                'digits_between:10,15',
                Rule::unique('pelanggan', 'telepon')->ignore($this->pelanggan),
            ],
            'alamat' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'nama_pelanggan.required' => 'Nama pelanggan harus diisi!',
            'telepon.required' => 'Nomor telepon harus diisi!',
            'telepon.numeric' => 'Nomor telepon harus berupa angka!',
            'telepon.digits_between' => 'Nomor telepon harus antara 10-15 digit!',
            'telepon.unique' => 'Nomor telepon sudah terdaftar!',
            'alamat.required' => 'Alamat harus diisi!',
        ];
    }
}