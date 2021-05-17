<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Produk extends Model
{
    use HasFactory;

    public $primaryKey = 'id_prduk';
    protected $fileable = [
        'id_kategori', 'kode_produk', 'nama', 'deskripsi', 'status', 'cover'
    ];
}
