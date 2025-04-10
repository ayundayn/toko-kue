<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';

    protected $primary = 'id';

    protected $fillable = ['nama_pelanggan', 'telepon', 'alamat'];

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'transaksi_id');
    }
}
