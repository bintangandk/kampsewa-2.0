<?php

namespace App\Http\Controllers;

use App\Mail\ReportStatusMail;
use App\Models\Penyewaan;
use App\Models\Report;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;


class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('dev');
    }

    public function index()
    {
        $title = "report-pending";
        $status = "pending";
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        $data = Report::with('penyewaan', 'pelapor', 'terlapor')->where('status', 'pending')->get();
        return view("developers.report", compact("title", "user_baru_terdaftar", "data", "status"));
    }
    public function report_terima()
    {
        $title = "report-terima";
        $status = "terima";
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        $data = Report::with('penyewaan', 'pelapor', 'terlapor')->where('status', 'terima')->get();
        return view("developers.report", compact("title", "user_baru_terdaftar", "data", "status"));
    }
    public function report_tolak()
    {
        $title = "report-tolak";
        $status = "tolak";
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        $data = Report::with('penyewaan', 'pelapor', 'terlapor')->where('status', 'tolak')->get();
        return view("developers.report", compact("title", "user_baru_terdaftar", "data", "status"));
    }






    public function verifikasi(Request $request)
    {
        $request->validate([
            'id_report' => 'required|exists:reports,id',
            'status' => 'required|in:terima,tolak'
        ]);

        $report = Report::findOrFail($request->id_report);
        $report->status = $request->status;
        $report->save();

        // Ambil data user
        $pelapor = User::find($report->id_pelapor);
        $terlapor = User::find($report->id_terlapor);

        // Kirim email berdasarkan status
        if ($request->status == 'terima') {
            $terlapor->SP += 1;
            $terlapor->save();

            // Kirim email ke pelapor dan terlapor
            // Mail::to($pelapor->email)->send(new ReportStatusMail($report, 'terima', 'pelapor'));
            // Mail::to($terlapor->email)->send(new ReportStatusMail($report, 'terima', 'terlapor'));
        } elseif ($request->status == 'tolak') {
            // Kirim email hanya ke pelapor
            // Mail::to($pelapor->email)->send(new ReportStatusMail($report, 'tolak', 'pelapor'));
        }

        Alert::success('Berhasil', 'Laporan berhasil diverifikasi');
        return redirect()->back();
    }


    public function detail_penyewaan_report($id_penyewaan, $status)
    {

        $status = $status;
        // dd($status);
        $penyewaan = Penyewaan::with('user', 'pembayaran', 'details.produk')->where('id', $id_penyewaan)->first();
        $title = "detail-pembayaran";
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();
        return view('developers.detail_penyewaan_report', compact('penyewaan', 'title', 'user_baru_terdaftar', 'status'));
    }
}
