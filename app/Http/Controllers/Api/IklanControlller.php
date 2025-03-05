<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Iklan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IklanControlller extends Controller
{

    // fungsi unuk menampilkan 10 iklan yang sedang aktif ditampilkan
    // menampilkan dengan parameter tanggal_mulai sama dengan tanggal sekarang
    // dan tanggal_akhir tidak lebih dari tanggal sekarang
    public function getAllIklan()
    {
        // buat variable untuk mendapatkan value waktu tanggal sekarang
        $today = Carbon::today();

        // menampilkan id iklan, poster, dan judul iklan dengan
        // mengambil data dari table iklan dengan cara join antara
        // iklan dan detail_iklan, data yang ditampilkan dimana tanggal
        // mulai harus sama dengan tanggal sekarang dan tanggal akhir tidak
        // boleh lebih dari tanggal sekarang, data yang ditampilkan hanya 10
        // data dengan menggunakan limit.
        $iklan = DB::table('iklan')
            ->join('detail_iklan', 'iklan.id', '=', 'detail_iklan.id_iklan')
            ->whereDate('detail_iklan.tanggal_mulai', '<=', $today)
            ->whereDate('detail_iklan.tanggal_akhir', '>=', $today)
            ->where('detail_iklan.status_iklan', 'like', '%aktif%')
            ->select('iklan.id', 'iklan.poster', 'iklan.judul')
            ->limit(10)
            ->get();


        // jika data tidak ada maka response json dengan
        // pesan http 404
        if (!$iklan) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Buat response JSON dengan status, message dan
        // data yang value berasal dari $iklan
        $response = [
            'status' => 'success',
            'message' => 'Data iklan berhasil diambil',
            'data' => $iklan,
        ];

        // response permintaan dengan json dengan status htto
        // kode 200 / permintaan berhasil
        return response()->json($response, 200);
    }

    // fungsi untuk menampilkan seluruh data iklan dan data id, nama
    // users
    public function getDetailIklan($identifier)
    {
        // buat variable untuk menampung nilai yaitu menggabungkan
        // table iklan dengan table users berdasarkan id, iklan
        // akan ditampilkan berdasarkan id dan judul dari table iklan
        $iklan = DB::table('iklan')
            ->leftJoin('users', 'iklan.id_user', '=', 'users.id')
            ->select('users.id as user_id', 'users.name as user_name', 'iklan.*')
            ->where('iklan.id', $identifier)
            ->orWhere('iklan.judul', 'like', '%' . $identifier . '%')
            ->first();

        // jika data tidak ada maka response json dengan
        // pesan http 404
        if (!$iklan) {
            return response()->json([
                'message' => 'Iklan not found'
            ], 404);
        }

        // jika ada maka response dengan json http 200
        return response()->json([
            'iklan' => $iklan,
            'message' => 'Success',
        ], 200);
    }
}
