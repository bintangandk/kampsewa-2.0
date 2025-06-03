<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
    use HasFactory;

    protected $table = 'iklan';

    protected $fillable = [
        'id_user',
        'poster',
        'judul',
        'sub_judul',
        'deskripsi',
        'snap_token',
    ];


    public function detail_iklan()
    {
        return $this->hasMany(DetailIklan::class, 'id_iklan', 'id');
    }
}
