<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPenggunaMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('dev');
    }
    public function index(Request $request)
    {
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        $get_total_user = User::where('type', 0)->count();
        $cari_customer = $request->query('cari_customer');
        $filter = $request->query('filter');

        $query = DB::table('produk')
            ->rightJoin('users', 'produk.id_user', '=', 'users.id')
            ->whereIn('users.type', [0]) // Filter user dengan type 0 (Customer)
            ->select(
                'users.id as user_id',
                'users.name',
                'users.nomor_telephone',
                'users.created_at',
                'users.jenis_kelamin',
                'users.foto',
                DB::raw('COUNT(produk.id) as total_product') // Menghitung total produk
            )
            ->groupBy('users.id', 'users.name', 'users.nomor_telephone', 'users.created_at', 'users.jenis_kelamin', 'users.foto');

        // Tambahkan klausa WHERE jika ada kata kunci pencarian
        if (!empty($cari_customer)) {
            $query->where(function ($query) use ($cari_customer) {
                $query->where('users.name', 'like', '%' . $cari_customer . '%')
                    ->orWhere('users.nomor_telephone', 'like', '%' . $cari_customer . '%')
                    ->orWhere('users.email', 'like', '%' . $cari_customer . '%');
            });
        }

        // Tambahkan urutan berdasarkan filter
        if ($filter == 'terlama') {
            $query->orderBy('users.created_at', 'asc');
        } else {
            $query->orderBy('users.created_at', 'desc');
        }

        $results = $query->paginate(10);


        return view('developers.kelola-pengguna')->with([
            'title' => 'Kelola Pengguna | Developer Kamp Sewa',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'get_total_user' => $get_total_user,
            'data' => $results,
            'cari_customer' => $cari_customer,
            'filter' => $filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
