<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    // fungsi api logout users
    public function logout(Request $request)
    {
        // request ambil data users yang sudah login
        $user = $request->user();

        // check apakah data ada jika ada jalankan blok
        // kode didalamnya
        if ($user) {
            // update status kolom table users terkait menjadi offline
            $user->status = 'offline';
            // jadikan null untuk kolom time_login
            $user->time_login = null;
            // simpan update perubahan
            $user->save();
            // hapus token login
            $user->currentAccessToken()->delete();
        }
        // response json dengan message berhasil logou 200 ok
        return response()->json(['message' => 'Berhasil LogOut'], 200);
    }
}
