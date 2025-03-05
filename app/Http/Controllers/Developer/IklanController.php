<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\DetailIklan;
use App\Models\Iklan;
use App\Models\PembayaranIklan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IklanController extends Controller
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

        // get count total transaksi iklan
        $get_count_total_transaksi_iklan = PembayaranIklan::all()->count();

        // get count total iklan pending
        $get_count_total_iklan_pending = DetailIklan::where('status_iklan', 'like', '%pending%')->count();

        // get count total iklan selesai
        $get_count_total_iklan_selesai = DetailIklan::where('status_iklan', 'like', '%selesai%')->count();

        // ambil request input cari
        $cari = $request->query('cari');

        // get data user iklan selesai
        $data_iklan_selesai = User::join('iklan', 'users.id', '=', 'iklan.id_user')
        ->join('detail_iklan', 'iklan.id', '=', 'detail_iklan.id_iklan')
        ->where('detail_iklan.status_iklan', 'like', '%selesai%')
        ->select('users.*', 'iklan.judul', 'iklan.id as id_iklan_main', 'detail_iklan.*')
        ->distinct()->paginate(10);
        $get_count_iklan_selesai = $data_iklan_selesai->count();

        // get data iklan aktif
        $data_iklan_aktif = User::join('iklan', 'users.id', '=', 'iklan.id_user')
        ->join('detail_iklan', 'iklan.id', '=', 'detail_iklan.id_iklan')
        ->where('detail_iklan.status_iklan', 'like', '%aktif%')
        ->select('users.*', 'iklan.judul', 'iklan.id as id_iklan_main', 'detail_iklan.*')
        ->distinct()->limit(10)->get();

        // get data user iklan pending
        $user_pending = User::join('iklan', 'users.id', '=', 'iklan.id_user')
            ->join('detail_iklan', 'iklan.id', '=', 'detail_iklan.id_iklan')
            ->where('detail_iklan.status_iklan', 'like', '%pending%')
            ->select('users.*', 'iklan.judul', 'iklan.id as id_iklan_main', 'detail_iklan.*')
            ->distinct();

        //    Tambahkan klausa WHERE jika ada kata kunci pencarian
        if (!empty($cari)) {
            $user_pending->where(function ($query) use ($cari) {
                $query->where('name', 'like', '%' . $cari . '%')
                    ->orWhere('nomor_telephone', 'like', '%' . $cari . '%')
                    ->orWhere('email', 'like', '%' . $cari . '%');
            });
        }

        $user_pending = $user_pending->paginate(10);

        return view('developers.iklan')->with([
            'title' => 'Iklan Customer',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'get_count_total_transaksi_iklan' => $get_count_total_transaksi_iklan,
            'get_count_total_iklan_pending' => $get_count_total_iklan_pending,
            'get_count_total_iklan_selesai' => $get_count_total_iklan_selesai,
            'user_pending' => $user_pending,
            'cari' => $cari,
            'data_iklan_selesai' => $data_iklan_selesai,
            'data_iklan_aktif' => $data_iklan_aktif,
            'get_count_iklan_selesai' => $get_count_iklan_selesai
        ]);
    }

    public function deleteIklanPending($id_iklan)
    {
        Iklan::where('id', $id_iklan)->delete();
        Alert::toast('Berhasil Dihapus.');
        return back();
    }
}
