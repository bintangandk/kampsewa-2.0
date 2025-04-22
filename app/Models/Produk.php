<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id_user',
        'nama',
        'deskripsi',
        'status',
        'kategori',
        'foto_depan',
        'foto_belakang',
        'foto_kiri',
        'foto_kanan',
    ];

    public function ratings()
    {
        return $this->hasMany(RatingProduk::class, 'id_produk');
    }

    public function storeUser()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
