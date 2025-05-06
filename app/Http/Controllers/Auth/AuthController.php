<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', ['title' => 'Login KampSewa']);
    }
    // ! fungsi untuk login
    public function login(Request $request)
    {
        // todo validasi sesuai dengan name input dan tidak boleh kosong
        $credentials = $request->validate([
            'nomor_telfon' => ['required'],
            'password' => ['required'],
        ]);

        // todo Cek apakah pengguna masuk menggunakan nomor telepon atau nama lengkap
        $user = User::where('nomor_telephone', $credentials['nomor_telfon'])
            ->orWhere('email', $credentials['nomor_telfon'])
            ->first();

        if ($user) {
            if (
                Auth::attempt(['nomor_telephone' => $user->nomor_telfon, 'password' => $credentials['password']]) ||
                Auth::attempt(['email' => $user->email, 'password' => $credentials['password']])
            ) {
                $request->session()->regenerate();

                // todo Mengambil pengguna yang berhasil login
                $user = auth()->user();

                // todo Menyimpan data nama lengkap dan level dalam sesi
                $request->session()->put('id_user', $user->id);
                $request->session()->put('nama_lengkap', $user->name);
                $request->session()->put('level', $user->type);
                $request->session()->put('foto', $user->foto);

                // todo cek user login sesuai dengan level dan dialihkan ke dashboard bersangkutan
                if ($user->type == 1) {
                    Alert::toast('Login success', 'success');
                    return redirect()->intended('/developer/dashboard/home')->with('success', 'Login success');
                } elseif ($user->type == 0) {
                    Alert::toast('Login success', 'success');
                    return redirect()->route('dashboard-cust')->with('success', 'Login success');
                }
            } else {
                Alert::toast('Password salah', 'error');
            }
        } else {
            Alert::toast('Pengguna tidak ditemukan', 'error');
        }
        return back()->withErrors([
            'nomor_telfon' => 'The provided credentials do not match our records.',
        ])->onlyInput('nomor_telfon');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::toast('Logout success', 'success');
        return redirect()->route('login');
    }
}
