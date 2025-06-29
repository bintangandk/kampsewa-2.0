<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'nomor_telephone',
        'tanggal_lahir',
        'foto',
        'status',
        'background',
        'jenis_kelamin',
        'time_login',
        'last_login',
        'name_store',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function rekomendasi()
    {
        return $this->hasMany(Rekomendasi::class, 'id_user', 'id');
    }


    public function pengeluaran()
    {
        return $this->hasMany(Pengeluaran::class, 'id_user', 'id');
    }
    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'id_user');
    }
}
