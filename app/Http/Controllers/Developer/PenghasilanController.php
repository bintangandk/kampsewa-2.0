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
        $currentMonth = Carbon::now()->monthName; // Nama bulan saat ini (Mei)
        $currentYear = Carbon::now()->year;

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
        $monthPreviousTotal_admin = PembayaranPenyewaan::whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->year)
            // ->sum('biaya_admin');
            ->sum('biaya_admin');
        $monthPreviousTotal_iklan = PembayaranIklan::whereMonth('created_at', Carbon::now()->subMonth()->month)->whereYear('created_at', Carbon::now()->year)
            // ->sum('total_bayar');

            ->where('status_bayar', 'aktif')->sum('total_bayar');
        $monthPreviousTotal = $monthPreviousTotal_admin + $monthPreviousTotal_iklan;
        // $monthCurrentTotal = Pemasukan::whereMonth('created_at', Carbon::now()->month)->sum('nominal');

        $monthCurrentTotal_admin = PembayaranPenyewaan::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->sum('biaya_admin');
        // dump(Carbon::now()->month);
        $monthCurrentTotal_iklan = PembayaranIklan::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)
            ->where('status_bayar', 'aktif')->sum('total_bayar');
        $monthCurrentTotal = $monthCurrentTotal_admin + $monthCurrentTotal_iklan;



        // // persentase perbandingan penghasilan total bulan ini dan total bulan lalu
        // if ($monthPreviousTotal != 0) {
        //     $persentase_perbandingan_total_bulan_ini = (($monthCurrentTotal - $totalPemasukanPerbulanSebelumBulanSaatIni) / $totalPemasukanPerbulanSebelumBulanSaatIni) * 100;
        // } else {
        //     $persentase_perbandingan_total_bulan_ini = $monthCurrentTotal > 0 ? 100 : 0;
        // }

        $startOfCurrentWeek = Carbon::now()->startOfWeek();
        $endOfCurrentWeek = Carbon::now()->endOfWeek();
        $startOfPreviousWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfPreviousWeek = Carbon::now()->subWeek()->endOfWeek();
        $currentWeekIncome = PembayaranPenyewaan::whereBetween('created_at', [$startOfCurrentWeek, $endOfCurrentWeek])->sum('biaya_admin')
            + PembayaranIklan::whereBetween('created_at', [$startOfCurrentWeek, $endOfCurrentWeek])
            ->where('status_bayar', 'aktif')
            ->sum('total_bayar');

        // Pendapatan minggu lalu
        $previousWeekIncome = PembayaranPenyewaan::whereBetween('created_at', [$startOfPreviousWeek, $endOfPreviousWeek])->sum('biaya_admin')
            + PembayaranIklan::whereBetween('created_at', [$startOfPreviousWeek, $endOfPreviousWeek])
            ->where('status_bayar', 'aktif')
            ->sum('total_bayar');

        $today = Carbon::today();

        $todayIncome = PembayaranPenyewaan::whereDate('created_at', $today)->sum('biaya_admin')
            + PembayaranIklan::whereDate('created_at', $today)
            ->where('status_bayar', 'aktif')
            ->sum('total_bayar');

        // Hitung minggu ke berapa dalam bulan ini
        $currentWeekOfMonth = Carbon::now()->weekOfMonth;
        $previousWeekOfMonth = Carbon::now()->subWeek()->weekOfMonth;

        // Hitung pendapatan 3 minggu sebelumnya (untuk perbandingan)
        $threeWeeksAgoIncome = 0;
        for ($i = 2; $i <= 4; $i++) {
            $start = Carbon::now()->subWeeks($i)->startOfWeek();
            $end = Carbon::now()->subWeeks($i)->endOfWeek();

            $threeWeeksAgoIncome += PembayaranPenyewaan::whereBetween('created_at', [$start, $end])->sum('biaya_admin')
                + PembayaranIklan::whereBetween('created_at', [$start, $end])
                ->where('status_bayar', 'aktif')
                ->sum('total_bayar');
        }

        // Hitung rata-rata 3 minggu sebelumnya
        $averageThreeWeeksAgo = $threeWeeksAgoIncome / 3;

        // Hitung persentase kenaikan
        $percentageIncrease = $averageThreeWeeksAgo != 0
            ? (($currentWeekIncome - $averageThreeWeeksAgo) / $averageThreeWeeksAgo) * 100
            : ($currentWeekIncome > 0 ? 100 : 0);

        return view('developers.penghasilan')->with([
            'title' => 'Penghasilan',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'penghasilan_tahun_ini' => $penghasilan_tahun_ini,
            'penghasilan_tahun_lalu' => $penghasilan_tahun_lalu,
            'persentase_perubahan' => $persentase_perubahan,
            'monthPreviousTotal' => $monthPreviousTotal,
            'monthCurrentTotal' => $monthCurrentTotal,
            // 'totalPemasukanPerbulan' => $totalPemasukanPerbulan,
            // 'totalPemasukanPerbulanSebelumBulanSaatIni' => $persentase_perbandingan_total_bulan_ini,
            'currentMonth' => $currentMonth,
            'todayIncome' => $todayIncome,
            'currentYear' => $currentYear,
            'currentWeekIncome' => $currentWeekIncome,
            'previousWeekIncome' => $previousWeekIncome,
            'currentWeekOfMonth' => $currentWeekOfMonth,
            'previousWeekOfMonth' => $previousWeekOfMonth,
            'percentageIncrease' => $percentageIncrease,
        ]);
    }
}
