<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PengeluaranController extends Controller
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

        // Tidak perlu decrypt id_user karena tidak digunakan
        // $id_user_decrypt = Crypt::decrypt($id_user);

        // mendefinisikan data pengeluaran berdasarkan type user = 1
        $search = request()->query('search');

        $data_pengeluaran = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        });

        if (!empty($search)) {
            $data_pengeluaran->where(function ($query) use ($search) {
                $query->where('sumber', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }


        // set variable untuk menampung request input
        $search = request()->query('search');
        $filter_tahun = request()->input('filter_tahun');
        $filter_bulan = request()->input('filter_bulan');

        // set tahun saat ini
        $tahun = Carbon::now()->year;

        // ambil total pemasukan tahun sekarang untuk user type 1
        // $total_tahun_sekarang = Pemasukan::whereHas('user', function ($query) {
        //     $query->where('type', '1');
        // })
        //     ->whereYear('created_at', Carbon::now()->year)
        //     ->sum('nominal');

        // // ambil total pemasukan tahun lalu untuk user type 1
        // $total_tahun_lalu = Pemasukan::whereHas('user', function ($query) {
        //     $query->where('type', '1');
        // })
        //     ->whereYear('created_at', Carbon::now()->subYear()->year)
        //     ->sum('nominal');

        // ambil total pengeluaran tahun ini untuk user type 1
        $pengeluaran_tahun_ini = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('nominal');

        // ambil total pengeluaran tahun lalu untuk user type 1
        $tahun_lalu = Carbon::now()->subYear()->year;
        $pengeluaran_tahun_lalu = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', $tahun_lalu)
            ->sum('nominal');

        // definisikan untuk set variable total pengeluaran perbulan untuk user type 1
        $total_perbulan = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', Carbon::now()->year);
        $total_bulan_ini = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1'); // Filter user type 1
        })
            ->whereYear('created_at', Carbon::now()->year) // Filter tahun ini
            ->whereMonth('created_at', Carbon::now()->month) // Filter bulan ini
            ->sum('nominal'); // Jumlahkan nominal

        // Hasilnya akan berupa angka (total pengeluaran bulan ini)

        // hitung presentase total pengeluaran tahun lalu
        // if ($pengeluaran_tahun_lalu != 0) {
        //     $kenaikan_persentase = (($pengeluaran_tahun_ini - $pengeluaran_tahun_lalu) / abs($pengeluaran_tahun_lalu)) * 100;
        //     $kenaikan_persentase = min($kenaikan_persentase, 100);
        // } else {
        //     $kenaikan_persentase = 0;
        // }

        // eksekusi baris didalam if jika request filter_tahun ada

        $pengeluaran_2tahun_lalu = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', Carbon::now()->subYears(2)->year) // ← 2 tahun lalu
            ->sum('nominal');

        if (request()->has('filter_tahun')) {
            $tahun = request()->input('filter_tahun');
            $data_pengeluaran->whereYear('created_at', $tahun);
            $pengeluaran_tahun_ini = Pengeluaran::whereHas('user', function ($query) {
                $query->where('type', '1');
            })
                ->whereYear('created_at', $tahun)
                ->sum('nominal');
            if ($pengeluaran_tahun_lalu != 0) {
                $kenaikan_persentase = (($pengeluaran_tahun_ini - $pengeluaran_tahun_lalu) / abs($pengeluaran_tahun_lalu)) * 100;
                $kenaikan_persentase = min($kenaikan_persentase, 100);
            } else {
                $kenaikan_persentase = 0;
            }
            $total_perbulan->whereYear('created_at', $tahun);
        }

        // ... (bagian kode lainnya tetap sama, pastikan untuk menambahkan whereHas pada setiap query)

        $total_perbulan_lalu = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->sum('nominal');
        $total_2bulan_lalu = Pengeluaran::whereHas('user', function ($query) {
            $query->where('type', '1');
        })
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->subMonth(2)->month)
            ->sum('nominal');

        // ... (sisa kode tetap sama)
        return view('developers.pengeluaran', [
            'title' => 'Pengeluaran',

            'user_baru_terdaftar' => $user_baru_terdaftar,
            "pengeluaran_tahun_ini" => $pengeluaran_tahun_ini,
            "pengeluaran_tahun_lalu" => $pengeluaran_tahun_lalu,
            // "kenaikan_persentase" => $kenaikan_persentase,
            "total_perbulan" => $total_perbulan->sum('nominal'),
            "total_perbulan_ini" => $total_bulan_ini,
            "total_perbulan_lalu" => $total_perbulan_lalu,
            "total_2bulan_lalu" => $total_2bulan_lalu,
            "data_pengeluaran" => $data_pengeluaran->orderBy('created_at', 'desc')->paginate(10),
            "tahun" => $tahun,
            "filter_tahun" => $filter_tahun,
            "filter_bulan" => $filter_bulan,
            "search" => $search,
            "pengeluaran_2tahun_lalu" => $pengeluaran_2tahun_lalu
        ]);
    }


    public function tambahPengeluaran(Request $request)
    {
        // validasi input
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

    public function hapusPengeluaran($id)
    {
        // hapus data pengeluaran
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);
            $pengeluaran->delete();
            Alert::toast('Data berhasil di hapus', 'success');
            return back();
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }


    public function  updatePenghasilan(Request $request)
    {


        $validation = Validator::make($request->all(), [
            // 'id_user' => 'string',
            'sumber' => 'required|string|max:50|min:5',
            'deskripsi' => 'required|string|max:255',
            'nominal' => 'required|integer',
        ]);
        if ($validation->fails()) {
            Alert::error('Error', $validation->errors()->first());
            return redirect()->back()->withErrors($validation)->withInput();
        }


        try {
            $pengeluaran = Pengeluaran::findOrFail($request->id);
            $pengeluaran->update([

                'id_user' => $request->id_user,
                'sumber' => $request->sumber,
                'deskripsi' => $request->deskripsi,
                'nominal' => $request->nominal,
            ]);
            Alert::toast('Data berhasil di update', 'success');
            return redirect()->route('pengeluaran.index');
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function exportPengeluaranDeveloperPdf(Request $request)
    {
        $search = $request->query('search', '');
        $startDate = $request->query('start_date', Carbon::now()->startOfYear());
        $endDate = $request->query('end_date', Carbon::now()->endOfYear());

        $developer = Auth::user();

        $query = Pengeluaran::query()
            ->whereBetween('created_at', [$startDate, $endDate])->whereHas('user', function ($query) {
                $query->where('type', '1');
            })
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('sumber', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Group by month-year
        $pengeluaranGrouped = $query->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->created_at)->format('F Y');
            });

        $grandTotal = $query->sum('nominal');

        $data = [
            'developer' => $developer,
            'pengeluaranGrouped' => $pengeluaranGrouped,
            'grandTotal' => $grandTotal,
            'startDate' => $startDate,
            'endDate' => $endDate
        ];

        $pdf = Pdf::loadView('developers.export.pengeluaran-developer-pdf', $data)
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-pengeluaran-developer-' . date('Y-m-d') . '.pdf');
    }
}
