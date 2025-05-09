<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DetailPenyewaan;
use App\Models\Pemasukan;
use App\Models\PembayaranPenyewaan;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardCustController extends Controller
{
    public function __construct()
    {
        $this->middleware('cust');
    }

    function totalPemasukanByYear($userId, $year)
    {
        return PembayaranPenyewaan::with('penyewaan')->whereYear('created_at', $year)

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
        return PembayaranPenyewaan::with('penyewaan')->whereYear('created_at', $year)
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

        $peralatanTerlaris = DetailPenyewaan::select('id_produk', DB::raw('SUM(qty) as total_qty'))
            ->whereHas('produk', function ($query) {
                $query->where('id_user', Auth::id()); // hanya produk milik user login
            })
            ->groupBy('id_produk')
            ->orderByDesc('total_qty')
            ->with('produk') // include relasi produk
            ->limit(5)
            ->get();

        $penyewaAktif = Penyewaan::with(['user', 'details.produk'])
            ->where('status_penyewaan', 'Aktif')
            ->whereDate('tanggal_selesai', '>=', Carbon::today())
            ->whereHas('details.produk', function ($query) {
                $query->where('id_user', Auth::id()); // hanya produk milik user login
            })
            ->take(5) // ambil 5 penyewaan aktif
            ->get();


        $penyewaSelesai = Penyewaan::with(['user', 'details.produk'])
            ->where('status_penyewaan', 'Aktif')
            ->whereDate('tanggal_selesai', '>=', Carbon::today())
            ->whereHas('details.produk', function ($query) {
                $query->where('id_user', Auth::id()); // hanya produk milik user login
            })
            ->take(5)
            ->get();


        $penyewaTelat = Penyewaan::with(['user', 'details.produk'])
            ->where('status_penyewaan', 'Aktif')
            ->whereDate('tanggal_selesai', '<', Carbon::today())
            ->whereHas('details.produk', function ($query) {
                $query->where('id_user', Auth::id());
            })
            ->take(5) // Batasi 5 data SEBELUM get()
            ->get()
            ->map(function ($penyewaan) {
                $hariTelat = Carbon::today()->diffInDays($penyewaan->tanggal_selesai);
                $penyewaan->hari_telat = $hariTelat;
                return $penyewaan;
            });
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
            'peralatanTerlaris' => $peralatanTerlaris,
            'penyewaAktif' => $penyewaAktif,
            'penyewaSelesai' => $penyewaSelesai,
            'penyewaTelat' => $penyewaTelat,
            // 'pemasukan_tahun_ini' => $pemasukan_tahun_ini,
            // 'pemasukan_tahun_lalu' => $pemasukan_tahun_lalu,
            // 'id' => $id_user_dec,
            // 'persentase_perbandingan_pertahun' => $kenaikan_persentase,
            // 'persentase_perbandingan_pertahun_dua_tahun_lalu' => $kenaikan_persentase_dua_tahun_lalu,
        ]);
    }
}
