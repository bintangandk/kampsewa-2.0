<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    use HasFactory;
    protected $table='detail_penyewaan';
    protected $fillable=[
        'id_penyewaan',
        'id_produk',
        'warna_produk',
        'ukuran',
        'qty',
        'subtotal',
    ];
}
