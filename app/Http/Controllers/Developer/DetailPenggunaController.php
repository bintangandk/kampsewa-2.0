<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailPenggunaController extends Controller
{
    public function __construct()
    {
        $this->middleware('dev');
    }
    public function index($namalengkap)
    {
        $name = $namalengkap;

        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        // get data user
        $data = DB::table('produk')
            ->rightJoin('users', 'produk.id_user', '=', 'users.id')
            ->whereIn('users.type', [0]) // Filter user dengan type 0 (Customer)
            ->select(
                'users.id as user_id',
                'users.name',
                'users.nomor_telephone',
                'users.created_at',
                'users.jenis_kelamin',
                'users.foto',
                'users.alamat',
                'users.tanggal_lahir',
                DB::raw('COUNT(produk.id) as total_product')
            )->where('users.name', $name)
            ->groupBy('users.id', 'users.name', 'users.nomor_telephone', 'users.created_at', 'users.jenis_kelamin', 'users.foto', 'users.alamat', 'users.tanggal_lahir')
            ->first();

        // Ambil data produk dari database
        // Ambil data produk dari database
        $produk = Produk::where('id_user', $data->user_id)->limit(2)->get();

        $totalStokPerProduk = [];

        // Iterasi setiap produk
        foreach ($produk as $p) {
            // Dekode JSON dari kolom variants
            $variants = json_decode($p->variants, true);

            $totalStok = 0;
            $totalHargaSewa = 0; // Inisialisasi total harga sewa

            // Iterasi setiap variant
            foreach ($variants as $variant) {
                // Jumlahkan stok dari setiap variant
                $totalStok += $variant['stok'];

                // Jumlahkan harga sewa dari setiap variant
                $totalHargaSewa += $variant['harga_sewa'];
            }

            // Simpan total stok dan total harga sewa per produk
            $p->total_variants = $totalStok; // Tambahkan properti total_variants ke objek produk
            $p->total_harga_sewa = $totalHargaSewa; // Tambahkan properti total_harga_sewa ke objek produk
            $totalStokPerProduk[] = $p; // Simpan objek produk dalam array
        }


        return view('developers.detail-pengguna')->with([
            'title' => 'Detail Pengguna',
            'name' => $name,
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'data' => $data,
            'data_produk_limit' => $totalStokPerProduk,
        ]);
    }
    public function showProdukDisewakan($namalengkap, Request $request)
    {
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        // Dapatkan data user
        $get_data_user = User::where('name', $namalengkap)->first();

        // Dapatkan kategori produk pengguna
        $get_kategori = Produk::where('id_user', $get_data_user->id)->pluck('kategori')->unique();

        // dapatkan semmua data produk
        $get_data_produk = Produk::where('id_user', $get_data_user->id)->get();
        // Iterasi setiap produk untuk menemukan harga sewa terkecil
        foreach ($get_data_produk as $produk) {
            $variants = json_decode($produk->variants, true);
            $harga_sewa_terkecil = null;

            // Cari harga sewa terkecil dari variants
            foreach ($variants as $variant) {
                if ($harga_sewa_terkecil === null || $variant['harga_sewa'] < $harga_sewa_terkecil) {
                    $harga_sewa_terkecil = $variant['harga_sewa'];
                }
            }

            // Tambahkan harga sewa terkecil ke objek produk
            $produk->harga_sewa_terkecil = $harga_sewa_terkecil;
        }

        // Ambil parameter filter dan pencarian dari request
        $filter_category = $request->query('filter_category');
        $cari_barang = $request->query('cari_barang');

        // Filter data produk berdasarkan kategori dan pencarian
        if ($filter_category && $filter_category != 'Semua Barang') {
            $get_data_produk = $get_data_produk->filter(function ($produk) use ($filter_category) {
                return $produk->kategori === $filter_category;
            });
        }

        if ($cari_barang) {
            $get_data_produk = $get_data_produk->filter(function ($produk) use ($cari_barang) {
                return stripos($produk->nama, $cari_barang) !== false ||
                    stripos($produk->description, $cari_barang) !== false ||
                    stripos(json_encode($produk->variants), $cari_barang) !== false;
            });
        }

        return view('developers.detailpengguna-produkdisewakan')->with([
            'name' => $namalengkap,
            'title' => 'Produk Disewakan',
            'user_baru_terdaftar' => $user_baru_terdaftar,
            'get_kategori' => $get_kategori,
            'get_data_produk' => $get_data_produk,
            'filter_category' => $filter_category,
            'cari_barang' => $cari_barang,
        ]);
    }
    public function showDetailProdukDisewakan($namalengkap, $nama_produk)
    {
        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        return view('developers.detail-produk-disewakan', ['title' => 'Detail Produk Disewakan', 'name' => $namalengkap, 'user_baru_terdaftar' => $user_baru_terdaftar, 'nama_produk' => $nama_produk]);
    }
    public function showDetailProdukSedangDisewa($namalengkap, $nama_produk)
    {

        $user_baru_terdaftar = User::select('users.*')
            ->join('status_notifikasi_user', 'users.id', '=', 'status_notifikasi_user.id_user')
            ->where('users.type', 0)
            ->whereDate('users.created_at', Carbon::today())
            ->where('status_notifikasi_user.status', 'unread')
            ->orderByDesc('users.created_at')->limit(10)
            ->get();

        return view('developers.detail-barang-sedangdisewa', ['title' => 'Detail Produk Sedang Disewa', 'name' => $namalengkap, 'nama_produk' => $nama_produk, 'user_baru_terdaftar' => $user_baru_terdaftar]);
    }

    public function deleteSelectedProducts(Request $request)
    {
        $ids = $request->input('ids');
        Produk::whereIn('id', $ids)->delete();

        return back()->with('success', 'Produk terpilih telah dihapus.');
    }
}
