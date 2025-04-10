<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $primary = 'id';

    protected $fillable = ['nama_kategori'];

    public function kue() {
        return $this->hasMany(Kue::class, 'id_kategori', 'id');
    }
}
