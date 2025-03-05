<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table='penyewaan';
    protected $fillable=[
        'id_user',
        'tanggal_mulai',
        'tanggal_selesai',
        'pesan',
        'status_penyewaan',
    ];
}
