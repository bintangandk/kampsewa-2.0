<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('dev');
    }
    public function index($nama_lengkap){
          // ambil user berdasarkan yang baru saja terdaftar
          $user_baru_terdaftar = User::select('users.*')
          ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
          ->where('users.type', 0)
          ->whereDate('users.created_at', Carbon::today())
          ->where('status_notifikasi_user.status', 'unread')
          ->orderByDesc('users.created_at')->limit(10)
          ->get();
        return view('developers.menu-profile.profile', ['title' => 'Profile | Developer Kamp Sewa', 'name' => $nama_lengkap, 'user_baru_terdaftar' => $user_baru_terdaftar]);
    }
}
