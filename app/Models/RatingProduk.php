<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingProduk extends Model
{
    use HasFactory;

    protected $table = 'rating_produk';

    protected $fillable = [
        'id_user',
        'id_produk',
        'rating',
        'ulasan',
    ];
}
