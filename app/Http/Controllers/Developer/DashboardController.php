<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckUserLogin;
use App\Models\Feedback;
use App\Models\Pemasukan;
use App\Models\PembayaranIklan;
use App\Models\PembayaranPenyewaan;
use App\Models\Pengeluaran;
use App\Models\Penyewaan;
use App\Models\Report;
use App\Models\StatusNotifikasiUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('dev');
    }
    public function index()
    {
        // -- variable list consume
        $currentDate = Carbon::now();
        $startOfCurrentMonth = $currentDate->copy()->startOfMonth();
        $endOfCurrentMonth = $currentDate->copy()->endOfMonth();
        $startOfPreviousMonth = $startOfCurrentMonth->copy()->subMonth()->startOfMonth();
        $endOfPreviousMonth = $startOfCurrentMonth->copy()->subMonth()->endOfMonth();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        // -- ambil user berdasarkan yang baru saja terdaftar
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        // -- Ambil total pengguna (customer)
        $total_pengguna = User::where('type', 0)->count();

        // -- total perbandingan jumlah customer minggu lalu dan sekarang
        $totalUsersPreviousMonth = User::where('type', 0)
            ->whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])
            ->count();
        $totalUsersCurrentMonth = User::where('type', 0)
            ->whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])
            ->count();
        if ($totalUsersPreviousMonth == 0) {
            $percentageChange = $totalUsersCurrentMonth > 0 ? 100 : 0;
        } else {
            $percentageChange = (($totalUsersCurrentMonth - $totalUsersPreviousMonth) / $totalUsersPreviousMonth) * 100;
        }
        $percentageChange = round($percentageChange, 2);

        // -- total feedback
        $total_report = Report::where('status', 'pending')->count();

        // -- total feedback perbandingan bulan lalu dan sekarang
        $totalFeedbackUsersPreviousMonth = Feedback::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->count();
        $totalFeedbackUsersCurrentMonth = Feedback::whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])->count();
        if ($totalFeedbackUsersPreviousMonth == 0) {
            $percentageFeedbackChange = $totalFeedbackUsersCurrentMonth > 0 ? 100 : 0;
        } else {
            $percentageFeedbackChange = (($totalFeedbackUsersCurrentMonth - $totalFeedbackUsersPreviousMonth) / $totalFeedbackUsersPreviousMonth) * 100;
        }
        $percentageFeedbackChange = round($percentageFeedbackChange, 2);

        $total_mitra = DB::table('produk')
            ->whereIn('id_user', function ($query) {
                $query->select('id')
                    ->from('users')
                    ->where('type', 0);
            })
            ->distinct()
            ->count('id_user');

        $totalMitraUsersPreviousMonth = User::where('type', 0)
            ->whereExists(function ($query) use ($startOfPreviousMonth, $endOfPreviousMonth) {
                $query->select(DB::raw(1))
                    ->from('produk')
                    ->whereColumn('users.id', 'produk.id_user')
                    ->whereBetween('produk.created_at', [$startOfPreviousMonth, $endOfPreviousMonth]);
            })
            ->count();

        $totalMitraUsersCurrentMonth = User::where('type', 0)
            ->whereExists(function ($query) use ($startOfCurrentMonth, $endOfCurrentMonth) {
                $query->select(DB::raw(1))
                    ->from('produk')
                    ->whereColumn('users.id', 'produk.id_user')
                    ->whereBetween('produk.created_at', [$startOfCurrentMonth, $endOfCurrentMonth]);
            })
            ->count();

        if ($totalMitraUsersPreviousMonth == 0) {
            $percentageMitraChange = $totalMitraUsersCurrentMonth > 0 ? 100 : 0;
        } else {
            $percentageMitraChange = (($totalMitraUsersCurrentMonth - $totalMitraUsersPreviousMonth) / $totalMitraUsersPreviousMonth) * 100;
        }
        $percentageMitraChange = round($percentageMitraChange, 2);

        // -- total pemasukan bulan ini
        $pemasukan_bulan_ini = Pemasukan::whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])->sum('nominal');
        $pemasukan_bulan_ini_ldr = number_format($pemasukan_bulan_ini, 0, ',', '.');

        // -- total pemasukan bulan lalu
        $pemasukan_bulan_lalu = Pemasukan::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->sum('nominal');
        $pemasukan_bulan_lalu_ldr = number_format($pemasukan_bulan_lalu, 0, ',', '.');

        // -- perbandingan pemasukan bulan lalu dan sekarang
        if ($pemasukan_bulan_lalu == 0) {
            $percentagePemasukanChange = $pemasukan_bulan_ini > 0 ? 100 : 0;
        } else {
            $percentagePemasukanChange = (($pemasukan_bulan_ini - $pemasukan_bulan_lalu) / $pemasukan_bulan_lalu) * 100;
        }
        $percentagePemasukanChange = round($percentagePemasukanChange, 2);

        // -- total pengeluaran bulan ini
        $pengeluaran_bulan_ini = Pengeluaran::whereBetween('created_at', [$startOfCurrentMonth, $endOfCurrentMonth])->sum('nominal');
        $pengeluaran_bulan_ini_ldr = number_format($pengeluaran_bulan_ini, 0, ',', '.');

        // -- total pengeluaran bulan lalu
        $pengeluaran_bulan_lalu = Pengeluaran::whereBetween('created_at', [$startOfPreviousMonth, $endOfPreviousMonth])->sum('nominal');
        $pengeluaran_bulan_lalu_ldr = number_format($pengeluaran_bulan_lalu, 0, ',', '.');


        $penyewaan = Penyewaan::count();

        // -- perbandingan pengeluaran bulan lalu dan sekarang
        if ($pengeluaran_bulan_lalu == 0) {
            $percentagePengeluaranChange = $pengeluaran_bulan_ini > 0 ? 100 : 0;
        } else {
            $percentagePengeluaranChange = (($pengeluaran_bulan_ini - $pengeluaran_bulan_lalu) / $pengeluaran_bulan_lalu) * 100;
        }
        $percentagePengeluaranChange = round($percentagePengeluaranChange, 2);

        // -- menghitung total keseluruhan nominal pemasukan dan nominal pengeluaran tahun saat ini
        // $total_pemasukan_tahun_ini = Pemasukan::whereYear('created_at', date('Y'))->sum('nominal');
        $penghasilan_tahun_ini_admin = PembayaranPenyewaan::whereYear('created_at', Carbon::now()->year)->sum('biaya_admin');
        $penghasilan_tahun_ini_iklan = PembayaranIklan::whereYear('created_at', Carbon::now()->year)->where('status_bayar', 'aktif')->sum('total_bayar');
        $total_pemasukan_tahun_ini = $penghasilan_tahun_ini_admin + $penghasilan_tahun_ini_iklan;
        $total_pengeluaran_tahun_ini = Pengeluaran::whereYear('created_at', date('Y'))
            ->whereHas('user', function ($query) {
                $query->where('type', '1');
            })
            ->sum('nominal');


        // -- menghitung total keuntungan
        $total_keuntungan = $total_pemasukan_tahun_ini - $total_pengeluaran_tahun_ini;
        if ($total_keuntungan <= 0) { // Jika total keuntungan <= 0
            $total_keuntungan = 0; // Ambil nilai absolut
            // ...
        }

        // Format total keuntungan
        if ($total_keuntungan >= 1000000) { // Jika total keuntungan >= 1 juta
            $formatted_keuntungan = number_format($total_keuntungan);
        } else { // Jika total keuntungan < 1 juta
            $formatted_keuntungan = number_format($total_keuntungan, 0);
        }

        // Hitung total kerugian
        $total_kerugian = $total_pengeluaran_tahun_ini - $total_pemasukan_tahun_ini;
        $total_kerugian = $total_kerugian < 0 ? 0 : $total_kerugian; // Ambil nilai absolut jika negatif
        // Format total kerugian
        if ($total_kerugian >= 1000000) {
            $formatted_kerugian = number_format($total_kerugian);
        } else if ($total_kerugian >= 100000) {
            $formatted_kerugian = number_format($total_kerugian);
        } else {
            $formatted_kerugian = number_format($total_kerugian, 0);
        }
        $total_pengeluaran_bulan_ini = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1'); // Filter user type 1
        })
            ->whereYear('created_at', Carbon::now()->year) // Filter tahun ini
            ->whereMonth('created_at', Carbon::now()->month) // Filter bulan ini
            ->sum('nominal'); // Jumlahkan nominal
        /*
        |--------------------------------------------------------------------------
        |-- get customer baru bulan ini
        |--------------------------------------------------------------------------
        */

        $_get_customer_baru_bulan_ini = User::where('type', 0)
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)->limit(5)->orderBy('created_at', 'desc')
            ->get();

        /*
        |--------------------------------------------------------------------------
        |-- get customer online
        |--------------------------------------------------------------------------
        */

        $_get_customer_online = User::where('type', 0)->where('status', 'online')->get();

        return view('developers.dashboard', [
            'title' => 'Dashboard | Developer Kamp Sewa',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'total_pengguna' => $total_pengguna,
            'percentageChange' => $percentageChange,
            'total_report' => $total_report,
            'percentageFeedbackChange' => $percentageFeedbackChange,
            'total_mitra' => $total_mitra,
            'penyewaan' => $penyewaan,
            'percentageMitraChange' => $percentageMitraChange,
            'pemasukan_bulan_ini' => $pemasukan_bulan_ini_ldr,
            'pemasukan_bulan_lalu' => $pemasukan_bulan_lalu_ldr,
            'percentagePemasukanChange' => $percentagePemasukanChange,
            'pengeluaran_bulan_ini' => $pengeluaran_bulan_ini_ldr,
            'pengeluaran_bulan_lalu' => $pengeluaran_bulan_lalu_ldr,
            'percentagePengeluaranChange' => $percentagePengeluaranChange,
            'total_keuntungan_tahun_ini' => $formatted_keuntungan,
            'total_kerugian_tahun_ini' => $formatted_kerugian,
            'customer_baru_bulan_ini' => $_get_customer_baru_bulan_ini,
            'total_pengeluaran_bulan_ini' => $total_pengeluaran_bulan_ini,
            'customer_online' => $_get_customer_online

        ]);
    }


    public function markNotificationAsRead()
    {
        $statusNotifikasi = StatusNotifikasiUser::where('status', 'unread')->get();
        foreach ($statusNotifikasi as $status) {
            $status->update(['status' => 'read']);
        }
        return back();
    }
}
