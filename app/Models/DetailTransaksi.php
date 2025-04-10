<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';

    protected $primary = 'id';

    protected $fillable = ['transaksi_id', 'kue_id', 'jumlah_kue', 'total_harga'];

    public function transaksi() {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function kue()
    {
        return $this->belongsTo(Kue::class, 'kue_id');
    }
}
