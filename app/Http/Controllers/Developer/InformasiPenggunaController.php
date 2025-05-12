<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class InformasiPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('dev');
    }
    public function index(Request $request)
    {
        // ambil user berdasarkan yang baru saja terdaftar
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        // get user pendaftar hari ini
        $user_pendaftar_hari_ini = User::where('created_at', '>=', Carbon::today())->where('type', 0)->count();

        // get pendaftar kemarin
        $user_pendaftar_kemarin = User::whereDate('created_at', Carbon::yesterday())->where('type', 0)->count();

        // get total pendaftar minggu ini
        $user_pendaftar_minggu_ini = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('type', 0)->count();

        // get total pendaftar minggu kemarin
        $user_pendaftar_minggu_kemarin = User::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->where('type', 0)->count();

        // get total pendaftar bulan ini
        $user_pendaftar_bulan_ini = User::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->where('type', 0)->count();

        // get total pendaftar bulan kemarin
        $user_pendaftar_bulan_kemarin = User::whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->where('type', 0)->count();

        // get total pendaftar tahun ini
        $user_pendaftar_tahun_ini = User::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->where('type', 0)->count();

        // get total pendaftar tahun kemarin
        $user_pendaftar_tahun_kemarin = User::whereBetween('created_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()])->where('type', 0)->count();

        // get user online
        $get_customer_online = User::where('type', 0)->where('status', 'online')->get();
        $count_customer_online = $get_customer_online->count();

        // get all users
        $get_all_user = User::where('type', 0)->count();

        $cari_customer = $request->query('cari');
        $filter_customer = $request->query('filter');
        $tidak_aktif = $request->query('tidak_aktif_sebulan');
        $produk_terbanyak = $request->query('produk_terbanyak');

        $query = DB::table('produk')
            ->rightJoin('users', 'produk.id_user', '=', 'users.id')
            ->whereIn('users.type', [0]) // Filter user dengan type 0 (Customer)
            ->select(
                'users.id as user_id',
                'users.name',
                'users.nomor_telephone',
                'users.created_at',
                'users.jenis_kelamin',
                'users.foto',
                'users.last_login',
                DB::raw('COUNT(produk.id) as total_product') // Menghitung total produk
            )
            ->groupBy('users.id', 'users.name', 'users.nomor_telephone', 'users.created_at', 'users.jenis_kelamin', 'users.foto');

        // Tambahkan klausa WHERE jika ada kata kunci pencarian
        if (!empty($cari_customer)) {
            $query->where(function ($query) use ($cari_customer) {
                $query->where('name', 'like', '%' . $cari_customer . '%')
                    ->orWhere('nomor_telephone', 'like', '%' . $cari_customer . '%')
                    ->orWhere('email', 'like', '%' . $cari_customer . '%');
            });
        }

        if ($tidak_aktif == 'tidak_aktif_sebulan') {
            $query->whereBetween('users.last_login', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
        }

        if ($produk_terbanyak == 'produk_terbanyak') {
            $query->orderBy('total_product', 'desc');
        }

        // Tambahkan urutan berdasarkan filter
        if ($filter_customer == 'terlama') {
            $query->orderBy('users.created_at', 'asc');
        } else {
            $query->orderBy('users.created_at', 'desc');
        }

        $users = $query->paginate(10);


        return view('developers.informas-pengguna')->with([
            'title' => 'Informasi Pengguna',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'user_pendaftar_hari_ini' => $user_pendaftar_hari_ini,
            'user_pendaftar_kemarin' => $user_pendaftar_kemarin,
            'user_pendaftar_minggu_ini' => $user_pendaftar_minggu_ini,
            'user_pendaftar_minggu_kemarin' => $user_pendaftar_minggu_kemarin,
            'user_pendaftar_bulan_ini' => $user_pendaftar_bulan_ini,
            'user_pendaftar_bulan_kemarin' => $user_pendaftar_bulan_kemarin,
            'user_pendaftar_tahun_ini' => $user_pendaftar_tahun_ini,
            'user_pendaftar_tahun_kemarin' => $user_pendaftar_tahun_kemarin,
            'users' => $users,
            'cari_customer' => $cari_customer,
            'filter_customer' => $filter_customer,
            'count' => $get_all_user,
            'tidak_aktif_sebulan' => $tidak_aktif,
            'get_customer_online' => $get_customer_online,
            'count_user_online' => $count_customer_online
        ]);
    }

    public function editProfile()
    {
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();
        return view('developers.menu-profile.edit_profile')->with([
            'title' => 'Edit Profile',
            'user_baru_terdaftar' => $user_baru_terdaftar
        ]);
    }

    public function updateProfile(Request $request)
    {
        // cek apakkah ada file gambar yang diupload

        if ($request->hasFile('foto')) {
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nomor_telephone' => 'required|digits_between:11,14',
                'email' => 'required|email|max:255|unique:users,email,' . auth()->user()->id,
                'jenis_kelamin' => 'required|string|max:10',
                'tanggal_lahir' => 'required|date',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        } else {
            # code...
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'nomor_telephone' => 'required|digits_between:11,14',
                'email' => 'required|email|max:255|unique:users,email,' . auth()->user()->id,
                'jenis_kelamin' => 'required|string|max:10',
            ]);
        }


        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->input('name');
        $user->nomor_telephone = $request->input('nomor_telephone');
        $user->email = $request->input('email');
        $user->jenis_kelamin = $request->input('jenis_kelamin');

        //  tempat nympan foto nya disini   src="{{ asset('assets/image/developers/' . auth()->user()->foto) }}" alt="Foto Profil">


        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/image/developers'), $filename);
            $user->foto = $filename; // hanya nama file saja

        }
        if ($user->save()) {

            Alert::success('Success', 'Profile updated successfully.');
            return redirect()->route('profile.index', ['nama_lengkap' => $request->name])
                ->with('success', 'Profile updated successfully.');
        } else {
            Alert::error('Error', 'Failed to update profile.');
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }
}
