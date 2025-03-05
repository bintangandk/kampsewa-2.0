<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('cust');
    }
    public function index($id_user)
    {
        // decrypt id user yang dikirimkan
        $id_user_decrypt = Crypt::decrypt($id_user);

        // get data pemasukan untuk
        $data_pemasukan = Pemasukan::where('id_user', $id_user_decrypt);

        $search = request()->query('search');
        $filter_tahun = request()->input('filter_tahun');
        $filter_bulan = request()->input('filter_bulan');

        $tahun = Carbon::now()->year;

        // get sum nominal tahun sekaran
        $total_tahun_sekarang = Pemasukan::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('nominal');

        // get sum nominal tahun lalu
        $total_tahun_lalu = Pemasukan::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->subYear()->year)
            ->sum('nominal');

        // get pengeluaran
        $pengeluaran_tahun_ini = Pengeluaran::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->year)->sum('nominal');
        $pengeluaran_tahun_lalu = Pengeluaran::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->subYear()->year)->sum('nominal');

        $total_perbulan = Pemasukan::where('id_user', $id_user_decrypt)->whereYear('created_at', Carbon::now()->year);

        // Hitung persentase kenaikan penghasilan
        if ($total_tahun_lalu != 0) {
            $kenaikan_persentase = (($total_tahun_sekarang - $total_tahun_lalu) / abs($total_tahun_lalu)) * 100;
            $kenaikan_persentase = min($kenaikan_persentase, 100);
        } else {
            $kenaikan_persentase = 0;
        }

        // Filter berdasarkan tahun jika ada
        if (request()->has('filter_tahun')) {
            $tahun = request()->input('filter_tahun');
            $data_pemasukan->whereYear('created_at', $tahun);
            $total_tahun_sekarang = Pemasukan::where('id_user', $id_user_decrypt)
                ->whereYear('created_at', $tahun)
                ->sum('nominal');
            if ($total_tahun_lalu != 0) {
                $kenaikan_persentase = (($total_tahun_sekarang - $total_tahun_lalu) / abs($total_tahun_lalu)) * 100;
                $kenaikan_persentase = min($kenaikan_persentase, 100);
            } else {
                $kenaikan_persentase = 0;
            }
            $total_perbulan->whereYear('created_at', $tahun);
        }
        // Filter berdasarkan bulan jika ada
        if (request()->has('filter_bulan')) {
            $bulan = request()->input('filter_bulan');
            if ($bulan !== 'semua_bulan') { // Jika bukan "semua bulan", lakukan filter
                $data_pemasukan->whereMonth('created_at', $bulan);
                $total_perbulan->whereMonth('created_at', $bulan);
            }
        }

        // Filter berdasarkan pencarian jika ada
        if ($search) {
            $data_pemasukan->where(function ($query) use ($search) {
                $query->where('nominal', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%");
            });
        }

        $get_data = $data_pemasukan->get();
        $get_total_tahun_sekarang = $total_tahun_sekarang;

        // Hitung total perbulan
        if (!request()->has('filter_bulan') || request()->input('filter_bulan') === 'semua_bulan') {
            $total_perbulan = $total_perbulan->whereMonth('created_at', Carbon::now()->month)->sum('nominal');
        } else {
            $total_perbulan = $total_perbulan->sum('nominal');
        }

        // Hitung persentase kenaikan penghasilan bulanan
        $total_perbulan_lalu = Pemasukan::where('id_user', $id_user_decrypt)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('nominal');
        if ($total_perbulan_lalu != 0) {
            $kenaikan_persentase_perbulan = (($total_perbulan - $total_perbulan_lalu) / abs($total_perbulan_lalu)) * 100;
            $persentase_perbulan = min($kenaikan_persentase_perbulan, 100);
        } else {
            $persentase_perbulan = 0;
        }

        // hitung persentase keuntungan
        $keuntungan_tahun_ini = $total_tahun_sekarang - $pengeluaran_tahun_ini;
        $keuntungan_tahun_lalu = $total_tahun_lalu - $pengeluaran_tahun_lalu;

        // jika keuntungan negatif, atur menjadi 0
        if ($keuntungan_tahun_ini < 0) {
            $keuntungan_tahun_ini = 0;
        }

        if ($keuntungan_tahun_lalu < 0) {
            $keuntungan_tahun_lalu = 0;
        }

        // Hitung persentase kenaikan keuntungan
        if ($keuntungan_tahun_lalu != 0) {
            $kenaikan_persentase_keuntungan = (($keuntungan_tahun_ini - $keuntungan_tahun_lalu) / abs($keuntungan_tahun_lalu)) * 100;
            $persentase_keuntungan = min($kenaikan_persentase_keuntungan, 100);
        } else {
            $persentase_keuntungan = 0;
        }

        return view('customers.menu-keuangan.menu-keuangan')->with([
            'title' => 'Menu Keuangan',
            'data_pemasukan' => $get_data,
            'total_tahun_sekarang' => $get_total_tahun_sekarang,
            'persentase_pertahun' => $kenaikan_persentase,
            'persentase_perbulan' => $persentase_perbulan,
            'total_perbulan' => $total_perbulan,
            'keuntungan' => $keuntungan_tahun_ini,
            'persentase_keuntungan' => $persentase_keuntungan,
            'search' => $search,
            'filter_tahun' => $filter_tahun,
            'filter_bulan' => $filter_bulan,
            'tahun' => $tahun,
        ]);
    }

    public function tambahPenghasilan($id_user)
    {
        try {
            request()->validate([
                'id_user' => 'string',
                'sumber' => 'required|string|max:50|min:5',
                'deskripsi' => 'required|string|max:255',
                'nominal' => 'required|integer',
            ]);

            $pemasukan = new Pemasukan();
            $pemasukan->id_user = request()->id_user;
            $pemasukan->sumber = strtoupper(request()->sumber);
            $pemasukan->deskripsi = request()->deskripsi;
            $pemasukan->nominal = request()->nominal;

            $pemasukan->save();

            Alert::toast('Data berhasil di simpan', 'success');
            return redirect('/customer/dashboard/keuangan/' . $id_user);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function updatePenghasilan($id_penghasilan)
    {
        $id_penghasilan_decrypt = Crypt::decrypt($id_penghasilan);

        $get_data = Pemasukan::where('id', $id_penghasilan_decrypt)->first();

        return view('customers.menu-keuangan.update-keuangan')->with([
            'title' => 'Update Keuangan',
            'data_update' => $get_data,
        ]);
    }

    public function updatePenghasilanPost($id_penghasilan, $id_user)
    {
        try {
            $validate_data = request()->validate([
                'sumber' => 'required|string',
                'deskripsi' => 'required|string',
                'nominal' => 'required|integer',
            ]);

            $get_data = Pemasukan::where('id', $id_penghasilan)->first();

            if (!$get_data) {
                Alert::toast('Data tidak ditemukan', 'warning');
                return back();
            }

            $get_data->update($validate_data);

            Alert::toast('Data berhasil di update', 'success');
            return redirect()->route('keuangan.index', ['id_user' => $id_user]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }
    public function deletePenghasilan($id_penghasilan)
    {
        try {
            $get_data = Pemasukan::where('id', $id_penghasilan);
            $get_data->delete();

            Alert::toast('Data berhasil dihapus!', 'success');

            return back();
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function downloadPenghasilan($id_user, $tahun)
    {
        $user = User::select('name')->where('id', $id_user)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $totalPertahun = Pemasukan::where('id_user', $id_user)
            ->whereYear('created_at', $tahun)
            ->sum('nominal');

        // Ambil data pemasukan untuk setiap bulan
        $monthlyIncome = [];
        $currentYear = date('Y');
        $currentMonth = date('n');

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            if (($tahun == $currentYear && $bulan <= $currentMonth) || $tahun < $currentYear) {
                $monthlyIncome[$bulan]['bulan'] = date('F', mktime(0, 0, 0, $bulan, 1));
                $monthlyIncome[$bulan]['total_nominal'] = 0;

                $monthlyIncome[$bulan]['data_pemasukan'] = Pemasukan::where('id_user', $id_user)
                    ->whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $bulan)
                    ->get();

                foreach ($monthlyIncome[$bulan]['data_pemasukan'] as $pemasukan) {
                    $monthlyIncome[$bulan]['total_nominal'] += $pemasukan->nominal;
                }
            }
        }

        $data = [
            'user' => $user,
            'monthlyIncome' => $monthlyIncome,
            'tahun' => $tahun,
            'totalPertahun' => $totalPertahun,
        ];

        $pdf = PDF::loadView('customers.menu-keuangan.pdf-penghasilan', $data);
        $fileName = 'penghasilan_' . $user->name . '.pdf';
        return $pdf->download($fileName);
    }

    public function pengeluaran($id_user)
    {
        // memecah enkripsi id user menjadi id utuh
        $id_user_decrypt = Crypt::decrypt($id_user);

        // mendefinisikan data pengeluaran berdasarkan id user
        $data_pengeluaran = Pengeluaran::where('id_user', $id_user_decrypt);

        // set variable untuk menampung request input
        $search = request()->query('search');
        $filter_tahun = request()->input('filter_tahun');
        $filter_bulan = request()->input('filter_bulan');

        // set tahun saat ini
        $tahun = Carbon::now()->year;

        // ambil total pemasukan tahun sekarang
        $total_tahun_sekarang = Pemasukan::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('nominal');

        // ambil total pemasukan tahun lalu
        $total_tahun_lalu = Pemasukan::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->subYear()->year)
            ->sum('nominal');

        // ambil total pengeluaran tahun ini
        $pengeluaran_tahun_ini = Pengeluaran::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->year)->sum('nominal');

        // ambil total pengeluaran tahun lalu
        $pengeluaran_tahun_lalu = Pengeluaran::where('id_user', $id_user_decrypt)
            ->whereYear('created_at', Carbon::now()->subYear()->year)->sum('nominal');

        // definisikan untuk set variable total pengeluaran perbulan
        $total_perbulan = Pengeluaran::where('id_user', $id_user_decrypt)->whereYear('created_at', Carbon::now()->year);

        // hitung presentase total pengeluaran tahun lalu
        if ($pengeluaran_tahun_lalu != 0) {
            $kenaikan_persentase = (($pengeluaran_tahun_ini - $pengeluaran_tahun_lalu) / abs($pengeluaran_tahun_lalu)) * 100;
            $kenaikan_persentase = min($kenaikan_persentase, 100);
        } else {
            $kenaikan_persentase = 0;
        }

        // eksekusi baris didalam if jika request filter_tahun ada
        if (request()->has('filter_tahun')) {
            $tahun = request()->input('filter_tahun');
            $data_pengeluaran->whereYear('created_at', $tahun);
            $pengeluaran_tahun_ini = Pengeluaran::where('id_user', $id_user_decrypt)
                ->whereYear('created_at', $tahun)
                ->sum('nominal');
            if ($pengeluaran_tahun_lalu != 0) {
                $kenaikan_persentase = (($total_tahun_sekarang - $total_tahun_lalu) / abs($total_tahun_lalu)) * 100;
                $kenaikan_persentase = min($kenaikan_persentase, 100);
            } else {
                $kenaikan_persentase = 0;
            }
            $total_perbulan->whereYear('created_at', $tahun);
        }
        if (request()->has('filter_bulan')) {
            $bulan = request()->input('filter_bulan');
            if ($bulan !== 'semua_bulan') {
                $data_pengeluaran->whereMonth('created_at', $bulan);
                $total_perbulan->whereMonth('created_at', $bulan);
            }
        }
        if ($search) {
            $data_pengeluaran->where(function ($query) use ($search) {
                $query->where('nominal', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%");
            });
        }
        $get_data = $data_pengeluaran->get();
        $get_total_tahun_sekarang = $pengeluaran_tahun_ini;
        if (!request()->has('filter_bulan') || request()->input('filter_bulan') === 'semua_bulan') {
            $total_perbulan = $total_perbulan->whereMonth('created_at', Carbon::now()->month)->sum('nominal');
        } else {
            $total_perbulan = $total_perbulan->sum('nominal');
        }
        $total_perbulan_lalu = Pengeluaran::where('id_user', $id_user_decrypt)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('nominal');
        if ($total_perbulan_lalu != 0) {
            $kenaikan_persentase_perbulan = (($total_perbulan - $total_perbulan_lalu) / abs($total_perbulan_lalu)) * 100;
            $persentase_perbulan = min($kenaikan_persentase_perbulan, 100);
        } else {
            $persentase_perbulan = 0;
        }

        $get_pengeluaran_hari_ini = $data_pengeluaran->whereDay('created_at', Carbon::now()->day)->sum('nominal');
        $get_pengeluaran_hari_lalu = $data_pengeluaran->whereDay('created_at', Carbon::now()->day)->sum('nominal');

        if ($get_pengeluaran_hari_lalu != 0) {
            $kenaikan_persentase_perhari = (($get_pengeluaran_hari_ini - $get_pengeluaran_hari_lalu) / abs($get_pengeluaran_hari_lalu)) * 100;
            $result_perhari = min($kenaikan_persentase_perhari, 100);
        } else {
            $result_perhari = 0;
        }
        return view('customers.menu-keuangan.pengeluaran')->with([
            'title' => 'Menu Pengeluaran',
            'data_pemasukan' => $get_data,
            'total_tahun_sekarang' => $get_total_tahun_sekarang,
            'persentase_pertahun' => $kenaikan_persentase,
            'persentase_perbulan' => $persentase_perbulan,
            'total_perbulan' => $total_perbulan,
            'total_hari_ini' => $get_pengeluaran_hari_ini,
            'persentase_perhari' => $result_perhari,
            'search' => $search,
            'filter_tahun' => $filter_tahun,
            'filter_bulan' => $filter_bulan,
            'tahun' => $tahun,
        ]);
    }

    public function tambahPengeluaran($id_user)
    {
        try {
            request()->validate([
                'id_user' => 'string',
                'sumber' => 'required|string|max:50|min:5',
                'deskripsi' => 'required|string|max:255',
                'nominal' => 'required|integer',
            ]);

            $pemasukan = new Pengeluaran();
            $pemasukan->id_user = request()->id_user;
            $pemasukan->sumber = strtoupper(request()->sumber);
            $pemasukan->deskripsi = request()->deskripsi;
            $pemasukan->nominal = request()->nominal;

            $pemasukan->save();

            Alert::toast('Data berhasil di simpan', 'success');
            return back();
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function updatePengeluaran($id_pengeluaran)
    {
        $id_penghasilan_decrypt = Crypt::decrypt($id_pengeluaran);

        $get_data = Pengeluaran::where('id', $id_penghasilan_decrypt)->first();

        return view('customers.menu-keuangan.update-pengeluaran')->with([
            'title' => 'Update Pengeluaran',
            'data_update' => $get_data,
        ]);
    }

    public function updatePengeluaranPost($id_pengeluaran, $id_user)
    {
        try {
            $validate_data = request()->validate([
                'sumber' => 'required|string',
                'deskripsi' => 'required|string',
                'nominal' => 'required|integer',
            ]);

            $get_data = Pengeluaran::where('id', $id_pengeluaran)->first();

            if (!$get_data) {
                Alert::toast('Data tidak ditemukan', 'warning');
                return back();
            }

            Log::info('Data to Update:', $get_data->toArray());

            $get_data->update($validate_data);

            Alert::toast('Data berhasil di update', 'success');
            return redirect()->route('keuangan.pengeluaran-customer', ['id_user' => $id_user]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function deletePengeluaran($id_pengeluaran)
    {
        try {
            $get_data = Pengeluaran::where('id', $id_pengeluaran);
            $get_data->delete();

            Alert::toast('Data berhasil dihapus!', 'success');

            return back();
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function downloadPengeluaran($id_user, $tahun)
    {
        $user = User::select('name')->where('id', $id_user)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $totalPertahun = Pengeluaran::where('id_user', $id_user)
            ->whereYear('created_at', $tahun)
            ->sum('nominal');

        // Ambil data pemasukan untuk setiap bulan
        $monthlyIncome = [];
        $currentYear = date('Y');
        $currentMonth = date('n');

        for ($bulan = 1; $bulan <= 12; $bulan++) {
            if (($tahun == $currentYear && $bulan <= $currentMonth) || $tahun < $currentYear) {
                $monthlyIncome[$bulan]['bulan'] = date('F', mktime(0, 0, 0, $bulan, 1));
                $monthlyIncome[$bulan]['total_nominal'] = 0;

                $monthlyIncome[$bulan]['data_pemasukan'] = Pengeluaran::where('id_user', $id_user)
                    ->whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $bulan)
                    ->get();

                foreach ($monthlyIncome[$bulan]['data_pemasukan'] as $pemasukan) {
                    $monthlyIncome[$bulan]['total_nominal'] += $pemasukan->nominal;
                }
            }
        }

        $data = [
            'user' => $user,
            'monthlyIncome' => $monthlyIncome,
            'tahun' => $tahun,
            'totalPertahun' => $totalPertahun,
        ];

        $pdf = PDF::loadView('customers.menu-keuangan.pdf-pengeluaran', $data);
        $fileName = 'pengeluaran_' . $user->name . '.pdf';
        return $pdf->download($fileName);
    }
}
