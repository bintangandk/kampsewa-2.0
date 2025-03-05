<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // fungsi authtenticate login
    public function login(Request $request)
    {
        // ambil validasi kiriman request dari input
        // identifier dan password
        $request->validate([
            'identifier' => ['required'],
            'password' => ['required'],
        ]);

        // ambil data user dimana nomor telephone atau
        // email sama dengan input yang dikirim user
        $user = User::where('nomor_telephone', $request->identifier)
            ->orWhere('email', $request->identifier)
            ->first();

        // check apakah data user true/ada jika ada jalankan
        // block kode didalamnya
        if ($user) {
            // check apakah data user dengan kolom type nilainya
            // tidak sama dengan 0 jika benar jalankan block kode
            // didlamnya
            if ($user->type !== 0) {
                // kirimkan response dengan message dan http code 401
                return response()->json(['message' => 'Maaf, Anda tidak memiliki hak akses untuk login.'], 401);
            }

            // hash password dari user untuk konversi dari code bycrypt menjadi
            // huruf tertata dan samakan nilainya apakah nilai password yang
            // di kirimkan dari input request user sama dengan password yang
            // ada di database jika ada maka lanjutkan block kode didalamnya
            if (Hash::check($request->password, $user->password)) {
                // buat token dengan key 'API Token' dan disimpan pada variable $token
                $token = $user->createToken('API Token')->plainTextToken;

                // update kolom status user menjadi online dengan menyamakan
                // dengan mengambil data user berdasarkan nomor dan email lalu
                // ditampung pada variable $user_online
                $user_online = User::where('nomor_telephone', $request->identifier)
                    ->orWhere('email', $request->identifier)
                    ->first()->update(['status' => 'online']);

                // digunakan untuk mengambil data user kembali berdasarkan
                // nomor dan email
                $user_online = User::where('nomor_telephone', $request->identifier)
                    ->orWhere('email', $request->identifier)
                    ->first();

                // check apakah data pada $user_online ada jika ada
                // jalankan blok kode didalamnya
                if ($user_online) {
                    // maka simpan / update kolom time_login, last_login
                    // pada table users dengan nilai tanggal dan waktu sekarang
                    $user_online->time_login = now();
                    $user_online->last_login = now();

                    // lakukan save untuk menyimpan / update data table users
                    $user_online->save();
                }

                // kembalikan nilai dengan response bentuk json,
                // access_token untuk mengirim nilai token, token type adalah bearer
                // expires_at untuk waktu kadaluarsa token, user_online mengirimkan
                // status user, message nilai login berhasil, user mengirim keseluruhan data
                // pada table users dan response 200 / ok
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_at' => now()->addMinutes(60)->toDateTimeString(),
                    'user_online' => $user_online,
                    'message' => 'Login Berhasil',
                    'user' => $user,
                ], 200);

                // kirimkan response jika password yang dikirimkan dari input salah
                // dengan code http 401/data tidak valid
            } else {
                return response()->json(['message' => 'Password anda salah.'], 401);
            }

            // kirimkan response json message dengan http kode 401/data tidak valid
        } else {
            return response()->json(['message' => 'Username pengguna tidak ditemukan.'], 401);
        }
    }
}
