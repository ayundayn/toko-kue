<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kue extends Model
{
    use HasFactory;

    protected $table = 'kue';

    protected $primary = 'id';

    protected $fillable = ['nama_kue', 'harga', 'stok', 'kategori_id'];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailTransaksi() {
        return $this->hasMany(DetailTransaksi::class, 'kue_id');
    }
}
