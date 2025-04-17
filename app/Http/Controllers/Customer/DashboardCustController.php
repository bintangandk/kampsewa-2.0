<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class DashboardCustController extends Controller
{
    public function __construct()
    {
        $this->middleware('cust');
    }
    public function index($id_user)
    {



        // $p = Crypt::decrypt($id_user);


        // $pemasukan_dua_tahun_lalu = Pemasukan::where('id_user', $id_user_dec)
        //     ->whereYear('created_at', Carbon::now()->subYears(2)->year)->where('sumber', 'Penyewaan')
        //     ->sum('nominal');

        // $pemasukan_tahun_ini = Pemasukan::where('id_user', $id_user_dec)
        //     ->whereYear('created_at', Carbon::now()->year)->where('sumber', 'Penyewaan')
        //     ->sum('nominal');

        // $pemasukan_tahun_lalu = Pemasukan::where('id_user', $id_user_dec)
        //     ->whereYear('created_at', Carbon::now()->subYear()->year)->where('sumber', 'Penyewaan')
        //     ->sum('nominal');

        // if ($pemasukan_tahun_lalu != 0) {
        //     $kenaikan_persentase = (($pemasukan_tahun_ini - $pemasukan_tahun_lalu) / abs($pemasukan_tahun_lalu)) * 100;
        //     $kenaikan_persentase = min($kenaikan_persentase, 100);
        // } else {
        //     $kenaikan_persentase = 0;
        // }

        // if ($pemasukan_dua_tahun_lalu != 0) {
        //     $kenaikan_persentase_dua_tahun_lalu = (($pemasukan_tahun_lalu - $pemasukan_dua_tahun_lalu) / abs($pemasukan_dua_tahun_lalu)) * 100;
        //     $kenaikan_persentase_dua_tahun_lalu = min($kenaikan_persentase_dua_tahun_lalu, 100);
        // } else {
        //     $kenaikan_persentase_dua_tahun_lalu = 0;
        // }


        return view('customers.menu-dashboard-cust.dashboard')->with([
            'title' => 'Dashboard | Customer',
            // 'pemasukan_tahun_ini' => $pemasukan_tahun_ini,
            // 'pemasukan_tahun_lalu' => $pemasukan_tahun_lalu,
            // 'id' => $id_user_dec,
            // 'persentase_perbandingan_pertahun' => $kenaikan_persentase,
            // 'persentase_perbandingan_pertahun_dua_tahun_lalu' => $kenaikan_persentase_dua_tahun_lalu,
        ]);
    }
}
