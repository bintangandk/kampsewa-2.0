<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranIklan extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_iklan';

    protected $fillable = [
        'id_iklan',
        'id_user',
        'metode_bayar',
        'total_bayar',
        'status_bayar',
    ];
}
