<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranPenyewaan extends Model
{
    use HasFactory;
    protected $table = 'pembayaran_penyewaan';
    protected $fillable = [
        'id_penyewaan',
        'bukti_pembayaran',
        'jaminan_sewa',
        'jumlah_pembayaran',
        'kembalian_pembayaran',
        'biaya_admin',
        'kurang_pembayaran',
        'total_pembayaran',
        'total_denda',
        'metode',
        'jenis_transaksi',
        'status_pembayaran'
    ];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'id_penyewaan', 'id');
    }
}
