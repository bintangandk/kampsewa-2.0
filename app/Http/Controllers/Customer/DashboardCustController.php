<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\PembayaranPenyewaan;
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

    function totalPemasukanByYear($userId, $year)
    {
        return PembayaranPenyewaan::whereYear('created_at', $year)

            ->whereHas('penyewaan.details.produk', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })
            ->whereHas('penyewaan', function ($query) {
                $query->whereIn('status_penyewaan', ['Selesai', 'Aktif']);
            })


            ->get()
            ->sum(function ($pembayaran) {
                return $pembayaran->status_pembayaran === 'Lunas'
                    ? $pembayaran->total_pembayaran
                    : $pembayaran->jumlah_pembayaran;
            });
    }
    public function totalPemasukanByMonth($userId, $year, $month)
    {
        return PembayaranPenyewaan::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereHas('penyewaan.details.produk', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })
            ->whereHas('penyewaan', function ($query) {
                $query->whereIn('status_penyewaan', ['Selesai', 'Aktif']);
            })
            ->get()
            ->sum(function ($pembayaran) {
                return $pembayaran->status_pembayaran === 'Lunas'
                    ? $pembayaran->total_pembayaran
                    : $pembayaran->jumlah_pembayaran;
            });
    }
    public function index()
    {

        $now = Carbon::now();
        $currentYear = $now->year;
        $lastYear = $now->copy()->subYear()->year;
        $currentMonth = $now->month;
        $lastMonth = $now->copy()->subMonth()->month;
        $userId = auth()->user()->id;

        // $p = Crypt::decrypt($id_user);




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
        // dd($lastYear);
        $totalSekarang = $this->totalPemasukanByYear($userId, $currentYear);
        $totalKemarin = $this->totalPemasukanByYear($userId, $lastYear);
        $totalSekarangbulanini = $this->totalPemasukanByMonth($userId, $currentYear, $currentMonth);
        $totalKemarinbulanlalu = $this->totalPemasukanByMonth($userId, $currentYear, $lastMonth);





        return view('customers.menu-dashboard-cust.dashboard')->with([
            'title' => 'Dashboard | Customer',
            'totalSekarang' => $totalSekarang,
            'totalKemarin' => $totalKemarin,
            'totalSekarangbulanini' => $totalSekarangbulanini,
            'totalKemarinbulanlalu' => $totalKemarinbulanlalu,
            // 'pemasukan_tahun_ini' => $pemasukan_tahun_ini,
            // 'pemasukan_tahun_lalu' => $pemasukan_tahun_lalu,
            // 'id' => $id_user_dec,
            // 'persentase_perbandingan_pertahun' => $kenaikan_persentase,
            // 'persentase_perbandingan_pertahun_dua_tahun_lalu' => $kenaikan_persentase_dua_tahun_lalu,
        ]);
    }
}
