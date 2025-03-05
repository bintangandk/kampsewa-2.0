<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPencarian extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pencarian';

    protected $fillable = [
        'id_user',
        'kata_kunci'
    ];
}
