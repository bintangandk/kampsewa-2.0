<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\PembayaranIklan;
use App\Models\PembayaranPenyewaan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartWebController extends Controller
{
    public function ApiTotalKeuntungan()
    {
        $total_pemasukan_tahun_sekarang = Pemasukan::whereYear('created_at', date('Y'))->sum('nominal');
        $total_pengeluaran_tahun_sekarang = Pengeluaran::whereYear('created_at', date('Y'))->sum('nominal');

        $total_pemasukan_tahun_lalu = Pemasukan::whereYear('created_at', date('Y') - 1)->sum('nominal');
        $total_pengeluaran_tahun_lalu = Pengeluaran::whereYear('created_at', date('Y') - 1)->sum('nominal');

        // Menghitung total keuntungan tahun sekarang
        $total_keuntungan = abs($total_pemasukan_tahun_sekarang - $total_pengeluaran_tahun_sekarang);
        if ($total_keuntungan >= 1000000) {
            $formatted_keuntungan = number_format($total_keuntungan / 1000000, 0) . 'M';
        } else {
            $formatted_keuntungan = number_format($total_keuntungan, 0);
        }

        // Menghitung total keuntungan tahun lalu
        $total_keuntungan_lalu = abs($total_pemasukan_tahun_lalu - $total_pengeluaran_tahun_lalu);
        if ($total_keuntungan_lalu >= 1000000) {
            $formatted_keuntungan_lalu = number_format($total_keuntungan_lalu / 1000000, 0) . 'M';
        } else {
            $formatted_keuntungan_lalu = number_format($total_keuntungan_lalu, 0);
        }

        // Menghitung total kerugian tahun sekarang
        $total_kerugian = abs($total_pengeluaran_tahun_sekarang - $total_pemasukan_tahun_sekarang);
        if ($total_kerugian >= 1000000) {
            $formatted_kerugian = number_format($total_kerugian / 1000000, 0) . 'M';
        } else {
            $formatted_kerugian = number_format($total_kerugian, 0);
        }

        // Menghitung total kerugian tahun lalu
        $total_kerugian_lalu = abs($total_pengeluaran_tahun_lalu - $total_pemasukan_tahun_lalu);
        if ($total_kerugian_lalu >= 1000000) {
            $formatted_kerugian_lalu = number_format($total_kerugian_lalu / 1000000, 0) . 'M';
        } else {
            $formatted_kerugian_lalu = number_format($total_kerugian_lalu, 0);
        }

        return response()->json([
            'total' => [
                'total_keuntungan' => [
                    'keuntungan_tahun_saat_ini' => $formatted_keuntungan,
                    'keuntungan_tahun_lalu' => $formatted_keuntungan_lalu,
                ],
                'total_kerugian' => [
                    'kerugian_tahun_saat_ini' => $formatted_kerugian,
                    'kerugian_tahun_lalu' => $formatted_kerugian_lalu
                ],
            ],
        ]);
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
    public function apiChartMenuPenghasilan()
    {
        $year = Carbon::now()->year;
        $totalPemasukanPerBulan = [];

        for ($month = 1; $month <= 12; $month++) {
            $total = DB::table('pemasukan')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->sum('nominal');

            $totalPemasukanPerBulan[] = [
                'month' => Carbon::create()->month($month)->format('F'),
                'total' => $total
            ];
        }
        return response()->json(['total_pemasukan_per_bulan' => $totalPemasukanPerBulan], 200);
    }

    public function apiChartTotalPenghasilanPerbulanSaatIniMenuPenghasilan()
    {
        $time = Carbon::now()->month;

        for ($month = 1; $month <= $time; $month++) {
            $total = DB::table('pemasukan')
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->sum('nominal');
            $totalPemasukanPerBulan[] = [
                'month' => Carbon::create()->month($month)->format('F'),
                'total' => $total
            ];
        }

        return response()->json(['total_pemasukan_per_bulan' => $totalPemasukanPerBulan], 200);
    }

    public function apiPerbandinganPemasukanPertahunWebCust($id_user)
    {
        $total_perbulan_tahun_kemarin = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $total_pertahun = Pemasukan::where('id_user', $id_user)
                ->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', $bulan)
                ->where('sumber', 'Penyewaan')
                ->sum('nominal');
            $total_perbulan_tahun_kemarin[$bulan] = $total_pertahun;
        }
        if (!empty($total_perbulan_tahun_kemarin)) {
            return response()->json([
                'message' => 'success',
                'data_pertahun' => $total_perbulan_tahun_kemarin,
            ]);
        }
    }


    public function getWeeklyIncome()
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $weeklyIncome = [0, 0, 0, 0]; // Inisialisasi 4 minggu

        for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
            $weekNumber = (int)floor(($date->day - 1) / 7); // 0-3

            $dailyIncome = PembayaranPenyewaan::whereDate('created_at', $date)
                ->sum('biaya_admin')
                + PembayaranIklan::whereDate('created_at', $date)
                ->where('status_bayar', 'aktif')
                ->sum('total_bayar');

            if ($weekNumber < 4) {
                $weeklyIncome[$weekNumber] += $dailyIncome;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $weeklyIncome
        ]);
    }


    public function getMonthlyIncome()
    {
        $months = [];
        $incomes = [];

        // Ambil data 4 bulan terakhir termasuk bulan ini
        for ($i = 3; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->translatedFormat('M'); // Nama bulan singkat (Jan, Feb, dst)
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $monthlyIncome = PembayaranPenyewaan::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('biaya_admin')
                + PembayaranIklan::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('status_bayar', 'aktif')
                ->sum('total_bayar');

            $months[] = $monthName;
            $incomes[] = $monthlyIncome;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $months,
                'values' => $incomes
            ]
        ]);
    }



    // app/Http/Controllers/ExpenseController.php
    public function getExpenseData()
    {
        $year = now()->year;
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];

        // Data Pengeluaran Pertahun (per bulan dalam tahun ini)
        $yearlyExpenses = [];
        for ($month = 1; $month <= 12; $month++) {
            $total = Pengeluaran::whereHas('user', function ($query) {
                $query->where('type', '1');
            })
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->sum('nominal');

            $yearlyExpenses[] = $total;
        }

        // Data Pengeluaran Perbulan (12 bulan terakhir)
        $monthlyExpenses = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $total = Pengeluaran::whereHas('user', function ($query) {
                $query->where('type', '1');
            })
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->sum('nominal');

            $monthlyExpenses[] = $total;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'yearly' => [
                    'labels' => $monthNames,
                    'values' => $yearlyExpenses
                ],
                'monthly' => [
                    'labels' => array_map(function ($date) {
                        return now()->subMonths(11 - $date)->translatedFormat('M');
                    }, range(0, 11)),
                    'values' => $monthlyExpenses
                ]
            ]
        ]);
    }



    public function getYearlyProfitComparison()
    {
        $currentYear = now()->year;
        $years = [$currentYear, $currentYear - 1, $currentYear - 2, $currentYear - 3];
        $result = [];

        foreach ($years as $year) {
            // Hitung penghasilan
            $incomeAdmin = PembayaranPenyewaan::whereYear('created_at', $year)->sum('biaya_admin');
            $incomeAds = PembayaranIklan::whereYear('created_at', $year)
                ->where('status_bayar', 'aktif')
                ->sum('total_bayar');
            $totalIncome = $incomeAdmin + $incomeAds;

            // Hitung pengeluaran
            $totalExpense = Pengeluaran::whereHas('user', function ($query) {
                $query->where('type', '1');
            })
                ->whereYear('created_at', $year)
                ->sum('nominal');

            // Hitung keuntungan per bulan
            $monthlyProfit = [];
            for ($month = 1; $month <= 12; $month++) {
                $monthIncomeAdmin = PembayaranPenyewaan::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->sum('biaya_admin');
                $monthIncomeAds = PembayaranIklan::whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->where('status_bayar', 'aktif')
                    ->sum('total_bayar');
                $monthExpense = Pengeluaran::whereHas('user', function ($query) {
                    $query->where('type', '1');
                })
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->sum('nominal');

                $monthlyProfit[] = ($monthIncomeAdmin + $monthIncomeAds - $monthExpense) / 1000000; // Dalam juta
            }

            $result[] = [
                'year' => $year,
                'total_profit' => ($totalIncome - $totalExpense) / 1000000, // Dalam juta
                'monthly_profit' => $monthlyProfit
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }



    public function getIncomeChartData()
    {
        $userId = auth()->user()->id;
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;

        // Data tahun ini
        $currentYearData = [];
        for ($month = 1; $month <= 12; $month++) {
            $currentYearData[] = $this->totalPemasukanByMonth($userId, $currentYear, $month);
        }

        // Data tahun lalu
        $lastYearData = [];
        for ($month = 1; $month <= 12; $month++) {
            $lastYearData[] = $this->totalPemasukanByMonth($userId, $lastYear, $month);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'currentYear' => $currentYearData,
                'lastYear' => $lastYearData,
                'labels' => ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"]
            ]
        ]);
    }
}
