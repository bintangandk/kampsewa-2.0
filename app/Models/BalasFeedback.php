<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalasFeedback extends Model
{
    use HasFactory;

    protected $table = 'balas_feedback';

    protected $fillable = [
        'id_feedback',
        'id_user',
        'balasan',
    ];
}
