<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\PembayaranIklan;
use App\Models\PembayaranPenyewaan;
use App\Models\Pengeluaran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapKeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('dev');
    }
    public function index()
    {
        // ambil user berdasarkan yang baru saja terdaftar
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();
        $monthCurrentTotal_admin = PembayaranPenyewaan::whereMonth('created_at', Carbon::now()->month)->sum('biaya_admin');
        $monthCurrentTotal_iklan = PembayaranIklan::whereMonth('created_at', Carbon::now()->month)->where('status_bayar', 'aktif')->sum('total_bayar');
        $penghasilan_bulan_ini = $monthCurrentTotal_admin + $monthCurrentTotal_iklan;

        $monthCurrentTotal_pengeluaran = Pengeluaran::whereMonth('created_at', Carbon::now()->month)->whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->sum('nominal');

        $penghasilan_tahun_ini_admin = PembayaranPenyewaan::whereYear('created_at', Carbon::now()->year)->sum('biaya_admin');
        $penghasilan_tahun_ini_iklan = PembayaranIklan::whereYear('created_at', Carbon::now()->year)->where('status_bayar', 'aktif')->sum('total_bayar');
        $penghasilan_tahun_ini = $penghasilan_tahun_ini_admin + $penghasilan_tahun_ini_iklan;


        $currentYear = now()->year;
        $profitComparison = [];

        for ($i = 0; $i < 4; $i++) {
            $year = $currentYear - $i;

            $incomeAdmin = PembayaranPenyewaan::whereYear('created_at', $year)->sum('biaya_admin');
            $incomeAds = PembayaranIklan::whereYear('created_at', $year)
                ->where('status_bayar', 'aktif')
                ->sum('total_bayar');
            $totalIncome = $incomeAdmin + $incomeAds;

            $totalExpense = Pengeluaran::whereHas('user', function ($query) {
                $query->where('type', '1');
            })
                ->whereYear('created_at', $year)
                ->sum('nominal');

            $profit = $totalIncome - $totalExpense;

            $profitComparison[] = [
                'year' => $year,
                'profit' => $profit > 0 ? $profit : 0,
                'loss' => $profit < 0 ? abs($profit) : 0
            ];
        }

        $pengeluaran_tahun_ini = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('nominal');


        $pengeluaran_bulan_ini = $monthCurrentTotal_pengeluaran;

        if ($penghasilan_tahun_ini > $pengeluaran_tahun_ini) {
            $sisa_keuntungantahunini = $penghasilan_tahun_ini - $pengeluaran_tahun_ini;
            $kerugian_tahunini = 0;
        } elseif ($pengeluaran_tahun_ini > $penghasilan_tahun_ini) {
            $kerugian_tahunini = $pengeluaran_tahun_ini - $penghasilan_tahun_ini;
            $sisa_keuntungantahunini = 0;
        } else if ($pengeluaran_tahun_ini == $penghasilan_tahun_ini) {
            $sisa_keuntungantahunini = 0;
            $kerugian_tahunini = 0;
        }

        if ($penghasilan_bulan_ini > $pengeluaran_bulan_ini) {
            $keuntungan_bulan_ini = $penghasilan_bulan_ini - $pengeluaran_bulan_ini;
            $kerugian_bulan_ini = 0;
        } elseif ($pengeluaran_bulan_ini > $penghasilan_bulan_ini) {
            $kerugian_bulan_ini = $pengeluaran_bulan_ini - $penghasilan_bulan_ini;
            $keuntungan_bulan_ini = 0;
        } else if ($pengeluaran_bulan_ini == $penghasilan_bulan_ini) {
            $keuntungan_bulan_ini = 0;
            $kerugian_bulan_ini = 0;
        }

        // $total_pemasukan_bulan_ini = Pemasukan::whereMonth('created_at', Carbon::now()->month)->sum('nominal');
        // $total_pengeluaran_bulan_ini = Pengeluaran::whereMonth('created_at', Carbon::now()->month)->sum('nominal');
        // $sisa_keuntungan_bulan_ini = $total_pemasukan_bulan_ini - $total_pengeluaran_bulan_ini;
        // $kerugian_bulan_ini = 0;
        // if ($sisa_keuntungan_bulan_ini < 0) {
        //     $kerugian_bulan_ini = abs($sisa_keuntungan_bulan_ini);
        //     $sisa_keuntungan_bulan_ini = 0;
        // } else {
        //     $kerugian_bulan_ini = 0;
        // }

        # code...
        return view('developers.rekap-keuangan', [
            'title' => 'Rekap Keuangan | Developer',
            'user_baru_terdaftar' => $user_baru_terdaftar,

            'penghasilan_tahun_ini' => $penghasilan_tahun_ini,
            'pengeluaran_tahun_ini' => $pengeluaran_tahun_ini,
            'sisa_keuntungantahunini' => $sisa_keuntungantahunini,
            'kerugian_tahunini' => $kerugian_tahunini,
            'penghasilan_bulan_ini' => $penghasilan_bulan_ini,
            'pengeluaran_bulan_ini' => $pengeluaran_bulan_ini,
            'keuntungan_bulan_ini' => $keuntungan_bulan_ini,
            'kerugian_bulan_ini' => $kerugian_bulan_ini,

            'profitComparison' => $profitComparison,

        ]);
    }
}
