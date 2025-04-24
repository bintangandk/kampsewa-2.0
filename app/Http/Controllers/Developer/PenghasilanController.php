<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\PembayaranIklan;
use App\Models\PembayaranPenyewaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenghasilanController extends Controller
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

        // get total penghasilan tahun saat ini
        $penghasilan_tahun_ini_admin = PembayaranPenyewaan::whereYear('created_at', Carbon::now()->year)->sum('biaya_admin');
        $penghasilan_tahun_ini_iklan = PembayaranIklan::whereYear('created_at', Carbon::now()->year)->where('status_bayar', 'aktif')->sum('total_bayar');
        $penghasilan_tahun_ini = $penghasilan_tahun_ini_admin + $penghasilan_tahun_ini_iklan;

        // get total penghasilan tahun lalu
        $penghasilan_tahun_lalu_admin = PembayaranPenyewaan::whereYear('created_at', Carbon::now()->year - 1)->sum('biaya_admin');
        $penghasilan_tahun_lalu_iklan = PembayaranIklan::whereYear('created_at', Carbon::now()->year - 1)->where('status_bayar', 'aktif')->sum('total_bayar');
        $penghasilan_tahun_lalu = $penghasilan_tahun_lalu_admin + $penghasilan_tahun_lalu_iklan;

        // hitung presentase dari perbandingan penghasilan tahun ini - tahun lalu
        if ($penghasilan_tahun_lalu != 0) {
            $persentase_perubahan = (($penghasilan_tahun_ini - $penghasilan_tahun_lalu) / $penghasilan_tahun_lalu) * 100;
        } else {
            $persentase_perubahan = $penghasilan_tahun_ini > 0 ? 100 : 0;
        }

        // get total penghasilan bulan lalu dan sekarang
        $monthPreviousTotal_admin = PembayaranPenyewaan::whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('biaya_admin');
        $monthPreviousTotal_iklan = PembayaranIklan::whereMonth('created_at', Carbon::now()->subMonth()->month)->where('status_bayar', 'aktif')->sum('total_bayar');
        $monthPreviousTotal = $monthPreviousTotal_admin + $monthPreviousTotal_iklan;
        $monthCurrentTotal = Pemasukan::whereMonth('created_at', Carbon::now()->month)->sum('nominal');

        for ($month = 1; $month <= Carbon::now()->month; $month++) {
            $total = DB::table('pemasukan')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->sum('nominal');

            $totalPemasukanPerbulan[] = [
                'month' => Carbon::create()->month($month)->format('F'),
                'total' => $total,
            ];
        }

        $totalPemasukanPerbulanSebelumBulanSaatIni = 0;
        for ($month = 1; $month <= Carbon::now()->month - 1; $month++) {
            $total = DB::table('pemasukan')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->sum('nominal');

            $totalPemasukanPerbulanSebelumBulanSaatIni += $total;
        }

        // persentase perbandingan penghasilan total bulan ini dan total bulan lalu
        if ($monthPreviousTotal != 0) {
            $persentase_perbandingan_total_bulan_ini = (($monthCurrentTotal - $totalPemasukanPerbulanSebelumBulanSaatIni) / $totalPemasukanPerbulanSebelumBulanSaatIni) * 100;
        } else {
            $persentase_perbandingan_total_bulan_ini = $monthCurrentTotal > 0 ? 100 : 0;
        }

        return view('developers.penghasilan')->with([
            'title' => 'Penghasilan',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'penghasilan_tahun_ini' => $penghasilan_tahun_ini,
            'penghasilan_tahun_lalu' => $penghasilan_tahun_lalu,
            'persentase_perubahan' => $persentase_perubahan,
            'monthPreviousTotal' => $monthPreviousTotal,
            'monthCurrentTotal' => $monthCurrentTotal,
            'totalPemasukanPerbulan' => $totalPemasukanPerbulan,
            'totalPemasukanPerbulanSebelumBulanSaatIni' => $persentase_perbandingan_total_bulan_ini,
        ]);
    }
}
