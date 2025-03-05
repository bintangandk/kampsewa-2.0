<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusNotifikasiUser extends Model
{
    use HasFactory;

    protected $table = 'status_notifikasi_user';

    protected $fillable = [
        'id_user',
        'status',
    ];
}
