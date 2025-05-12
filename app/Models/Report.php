<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $guarded = ['id'];


    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan', 'id');
    }
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'id_pelapor', 'id');
    }
    public function terlapor()
    {
        return $this->belongsTo(User::class, 'id_terlapor', 'id');
    }
}
