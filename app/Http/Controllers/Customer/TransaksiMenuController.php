<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Bank;
use App\Models\DetailPenyewaan;
use App\Models\DetailVariantProduk;
use App\Models\PembayaranPenyewaan;
use App\Models\Penyewaan;
use App\Models\Produk;
use App\Models\User;
use App\Models\VariantProduk;
use Geocoder\Provider\Nominatim\Nominatim;
use Geocoder\Query\GeocodeQuery;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('cust');
    }
    public function index(Request $request, $id_user)
    {
        try {
            // Decrypt id_user
            $id_user_decrypt = Crypt::decrypt($id_user);

            // Ambil tanggal awal dan tanggal akhir dari query
            $filter_tanggal_awal = $request->query('tanggal_awal');
            $filter_tanggal_akhir = $request->query('tanggal_akhir');
            $search = $request->query('search');

            // Query untuk mengambil data transaksi
            $query = User::leftJoin('penyewaan', 'users.id', '=', 'penyewaan.id_user')
                ->leftJoin('detail_penyewaan', 'penyewaan.id', '=', 'detail_penyewaan.id_penyewaan')
                ->leftJoin('pembayaran_penyewaan', 'penyewaan.id', '=', 'pembayaran_penyewaan.id_penyewaan')
                ->leftJoin('produk', 'detail_penyewaan.id_produk', '=', 'produk.id')
                ->leftJoin('users as penyewa', 'produk.id_user', '=', 'penyewa.id')
                ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
                ->select(
                    'users.id as id_user_penyewa',
                    'users.foto as foto_users',
                    'users.name as nama_penyewa',
                    'penyewaan.id as id_penyewaan',
                    'penyewaan.tanggal_mulai',
                    'penyewaan.tanggal_selesai',
                    'penyewaan.status_penyewaan',
                    'pembayaran_penyewaan.status_pembayaran',
                    'pembayaran_penyewaan.metode',
                    'produk.id as id_produk',
                    'produk.foto_depan',
                    'produk.nama'
                )
                ->where('penyewa.id', $id_user_decrypt)
                ->where('penyewaan.status_penyewaan', 'Pending');

            // Filter berdasarkan rentang tanggal jika ada
            if ($filter_tanggal_awal && $filter_tanggal_akhir) {
                $query->whereBetween('penyewaan.created_at', [$filter_tanggal_awal, $filter_tanggal_akhir]);
            } elseif ($filter_tanggal_awal) {
                $query->whereDate('penyewaan.created_at', $filter_tanggal_awal);
            } elseif ($filter_tanggal_akhir) {
                $query->whereDate('penyewaan.created_at', $filter_tanggal_akhir);
            }

            if ($search) {
                $query->where('users.name', 'like', '%' . $search . '%');
            }

            $data = $query->get();

            // Membuat koleksi baru untuk hasil akhir
            $result = collect();

            $seenUsers = [];

            foreach ($data as $item) {
                if (!isset($seenUsers[$item->id_user_penyewa])) {
                    $first_product = DB::table('detail_penyewaan')
                        ->join('produk', 'detail_penyewaan.id_produk', '=', 'produk.id')
                        ->where('detail_penyewaan.id_penyewaan', $item->id_penyewaan)
                        ->select('produk.id as id_produk', 'produk.foto_depan', 'produk.nama')
                        ->first();

                    if ($first_product) {
                        $item->id_produk = $first_product->id_produk;
                        $item->foto_depan = $first_product->foto_depan;
                        $item->nama = $first_product->nama;
                    }

                    $result->push($item);
                    $seenUsers[$item->id_user_penyewa] = true;
                }
            }

            // Jika permintaan dari AJAX, kirim JSON response
            if ($request->ajax()) {
                return response()->json(['data' => $result]);
            }


            // dump($id_user_decrypt);

            return view('customers.menu-transaksi.home-transaksi')->with([
                'title' => 'Order Masuk',
                'id_user' => $id_user_decrypt,
                'data' => $result,
                'search' => $search,
            ]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function terimaOrderMasuk($id_penyewaan)
    {
        $id_penyewaan_decrypt = Crypt::decrypt($id_penyewaan);

        // Query untuk data yang hanya mengambil satu baris
        $singleData = Penyewaan::leftJoin('users', 'users.id', '=', 'penyewaan.id_user')
            ->leftJoin('pembayaran_penyewaan', 'penyewaan.id', '=', 'pembayaran_penyewaan.id_penyewaan')
            ->select(
                'users.id as id_user',
                'users.name',
                'users.foto',
                'users.nomor_telephone',
                'users.jenis_kelamin',
                'penyewaan.id as id_penyewaan',
                'penyewaan.tanggal_mulai',
                'penyewaan.tanggal_selesai',
                'penyewaan.status_penyewaan',
                'penyewaan.pesan',
                'pembayaran_penyewaan.id as id_pembayaran',
                'pembayaran_penyewaan.bukti_pembayaran',
                'pembayaran_penyewaan.jaminan_sewa',
                'pembayaran_penyewaan.jumlah_pembayaran',
                'pembayaran_penyewaan.total_pembayaran',
                'pembayaran_penyewaan.status_pembayaran',
                'pembayaran_penyewaan.biaya_admin'
            )->where('penyewaan.id', $id_penyewaan_decrypt)->first();

        // Query untuk data dari tabel 'bank'
        $banks = Bank::where('id_user', $singleData->id_user)->get();

        // Query untuk data dari tabel 'alamat'
        $address = Alamat::where('id_user', $singleData->id_user)->where('type', 0)->first();

        if ($address) {
            $latitude = $address->latitude;
            $longitude = $address->longitude;
            $addressString = $this->getAddressFromCoordinates($latitude, $longitude);
        } else {
            $addressString = 'Address not found'; // Atau sesuaikan dengan penanganan kasus jika alamat tidak ditemukan
        }

        // Query untuk data dari tabel 'detail_penyewaan' dan mengelompokkan berdasarkan id_produk
        $details = DetailPenyewaan::leftJoin('produk', 'produk.id', '=', 'detail_penyewaan.id_produk')
            ->select(
                'produk.id as id_produk',
                'produk.nama as produk_nama',
                'produk.kategori as produk_kategori',
                'produk.foto_depan as produk_foto',
                'produk.foto_belakang',
                'produk.foto_kiri',
                'produk.foto_kanan',
                'detail_penyewaan.warna_produk',
                'detail_penyewaan.ukuran',
                'detail_penyewaan.qty',
                'detail_penyewaan.subtotal'
            )
            ->where('detail_penyewaan.id_penyewaan', $id_penyewaan_decrypt)
            ->get()
            ->groupBy('id_produk');

        $total_harus_dibayar = DetailPenyewaan::where('id_penyewaan', $id_penyewaan_decrypt)->sum('subtotal');
        return view('customers.menu-transaksi.terima-order-masuk')->with([
            'title' => 'Terima Order Masuk',
            'data' => $singleData,
            'banks' => $banks,
            'address' => $addressString,
            'details' => $details,
            'harus_dibayar' => $total_harus_dibayar,
        ]);
    }

    private function getAddressFromCoordinates($latitude, $longitude)
    {
        $url = "https://nominatim.openstreetmap.org/reverse?lat={$latitude}&lon={$longitude}&format=json";

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['display_name'])) {
                    return $data['display_name'];
                }
            }

            return 'Address not found';
        } catch (\Exception $e) {
            return 'Error fetching address: ' . $e->getMessage();
        }
    }

    public function inputPembayaranCOD($id_penyewaan)
    {
        try {
            // Validasi input
            $validatedData = request()->validate([
                'jumlah_pembayaran' => 'required|integer',
                'kembalian_pembayaran' => 'required|integer',
                'kurang_pembayaran' => 'required|integer',
                'total_pembayaran' => 'required|integer',
                'jaminan_sewa' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // Proses upload file jaminan
            $jaminanSewa = request()->file('jaminan_sewa');
            $jaminanSewaName = time() . '_jaminan.' . $jaminanSewa->getClientOriginalExtension();
            $jaminanSewa->move(public_path('assets/image/customers/jaminan/'), $jaminanSewaName);

            // Tambahkan nama file ke array data yang akan diupdate
            $validatedData['jaminan_sewa'] = $jaminanSewaName;

            // Tentukan status pembayaran
            $validatedData['status_pembayaran'] = $validatedData['kurang_pembayaran'] > 0 ? 'Belum Lunas' : 'Lunas';

            // Update langsung dengan query builder
            PembayaranPenyewaan::where('id_penyewaan', $id_penyewaan)->update($validatedData);

            Alert::toast('Berhasil menyimpan pembayaran!', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::toast('Gagal menyimpan pembayaran: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }


    public function confirmOrderMasuk($id_penyewaan, $id_user, $parameter)
    {
        try {
            if ($parameter == 1) {
                $penyewaan = Penyewaan::where('id', $id_penyewaan)->update(['status_penyewaan' => 'Aktif']);
                if ($penyewaan) {
                    Alert::toast('Order berhasil diterima dan status User saat ini adalah aktif menyewa!, atau waktu penyewaan telah berjalan', 'success');
                    return redirect('customer/dashboard/transaksi/' . $id_user);
                } else {
                    return response()->json(['message' => 'Update failed'], 500);
                }
            } else {
                $penyewaan = Penyewaan::where('id', $id_penyewaan)->update(['status_penyewaan' => 'Selesai']);
                $detail_penyewaan = DetailPenyewaan::where('id_penyewaan', $id_penyewaan)->get();
                foreach ($detail_penyewaan as $item) {
                    $produk = Produk::where('id', $item->id_produk)->update(['status' => 'Tersedia']);
                    $variant = VariantProduk::where('id_produk', $item->id_produk)
                        ->where('warna', $item->warna_produk)
                        ->first();

                    // Jika varian ditemukan, lanjut cari detail varian
                    if ($variant) {
                        $detail_variant = DetailVariantProduk::where('id_variant_produk', $variant->id)
                            ->where('ukuran', $item->ukuran)
                            ->first();

                        // Jika detail varian ditemukan, update stok
                        if ($detail_variant) {
                            $detail_variant->stok += $item->qty;
                            $detail_variant->save();
                        }
                    }
                }


                if ($penyewaan) {
                    Alert::toast('Pengembalian berhasil di simpan!', 'success');
                    return redirect('customer/dashboard/order-selesai/' . $id_user);
                } else {
                    return response()->json(['message' => 'Update failed'], 500);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error in confirmOrderMasuk: ' . $e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function sewaBerlangsung($id_user, Request $request)
    {
        // Decrypt id_user
        $id_user_decrypt = Crypt::decrypt($id_user);

        // Ambil tanggal awal dan tanggal akhir dari query
        $filter_tanggal_awal = $request->query('tanggal_awal');
        $filter_tanggal_akhir = $request->query('tanggal_akhir');
        $search = $request->query('search');

        // Query untuk mengambil data transaksi
        $query = User::leftJoin('penyewaan', 'users.id', '=', 'penyewaan.id_user')
            ->leftJoin('detail_penyewaan', 'penyewaan.id', '=', 'detail_penyewaan.id_penyewaan')
            ->leftJoin('pembayaran_penyewaan', 'penyewaan.id', '=', 'pembayaran_penyewaan.id_penyewaan')
            ->leftJoin('produk', 'detail_penyewaan.id_produk', '=', 'produk.id')
            ->leftJoin('users as penyewa', 'produk.id_user', '=', 'penyewa.id')
            ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'users.id as id_user_penyewa',
                'users.foto as foto_users',
                'users.name as nama_penyewa',
                'penyewaan.id as id_penyewaan',
                'penyewaan.tanggal_mulai',
                'penyewaan.tanggal_selesai',
                'penyewaan.status_penyewaan',
                'pembayaran_penyewaan.status_pembayaran',
                'pembayaran_penyewaan.metode',
                'produk.id as id_produk',
                'produk.foto_depan',
                'produk.nama'
            )
            ->where('penyewa.id', $id_user_decrypt)
            ->where('penyewaan.status_penyewaan', 'Aktif');

        // Filter berdasarkan rentang tanggal jika ada
        if ($filter_tanggal_awal && $filter_tanggal_akhir) {
            $query->whereBetween('penyewaan.created_at', [$filter_tanggal_awal, $filter_tanggal_akhir]);
        } elseif ($filter_tanggal_awal) {
            $query->whereDate('penyewaan.created_at', $filter_tanggal_awal);
        } elseif ($filter_tanggal_akhir) {
            $query->whereDate('penyewaan.created_at', $filter_tanggal_akhir);
        }

        if ($search) {
            $query->where('users.name', 'like', '%' . $search . '%');
        }

        $data = $query->get();

        // Membuat koleksi baru untuk hasil akhir
        $result = collect();

        $seenUsers = [];

        foreach ($data as $item) {
            if (!isset($seenUsers[$item->id_user_penyewa])) {
                $first_product = DB::table('detail_penyewaan')
                    ->join('produk', 'detail_penyewaan.id_produk', '=', 'produk.id')
                    ->where('detail_penyewaan.id_penyewaan', $item->id_penyewaan)
                    ->select('produk.id as id_produk', 'produk.foto_depan', 'produk.nama')
                    ->first();

                if ($first_product) {
                    $item->id_produk = $first_product->id_produk;
                    $item->foto_depan = $first_product->foto_depan;
                    $item->nama = $first_product->nama;
                }

                $result->push($item);
                $seenUsers[$item->id_user_penyewa] = true;
            }
        }

        // Jika permintaan dari AJAX, kirim JSON response
        if ($request->ajax()) {
            return response()->json(['data' => $result]);
        }

        // dump($result);

        return view('customers.menu-transaksi.sewa-berlangsung')->with([
            'title' => 'Sewa Berlangsung',
            'id_user' => $id_user_decrypt,
            'data' => $result,
            'search' => $search,
        ]);
    }

    public function dendaTransaksi($id_user)
    {
        return view('customers.menu-transaksi.denda-transaksi')->with([
            'title' => 'Denda Pelanggan',
        ]);
    }

    public function orderSelesai($id_user, Request $request)
    {
        try {
            // Decrypt id_user
            $id_user_decrypt = Crypt::decrypt($id_user);

            // Ambil tanggal awal dan tanggal akhir dari query
            $filter = $request->query('filter-order-selesai');
            $search = $request->query('search');

            // Query untuk mengambil data transaksi
            $query = User::leftJoin('penyewaan', 'users.id', '=', 'penyewaan.id_user')
                ->leftJoin('detail_penyewaan', 'penyewaan.id', '=', 'detail_penyewaan.id_penyewaan')
                ->leftJoin('pembayaran_penyewaan', 'penyewaan.id', '=', 'pembayaran_penyewaan.id_penyewaan')
                ->leftJoin('produk', 'detail_penyewaan.id_produk', '=', 'produk.id')
                ->leftJoin('users as penyewa', 'produk.id_user', '=', 'penyewa.id')
                ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
                ->select(
                    'users.id as id_user_penyewa',
                    'users.foto as foto_users',
                    'users.name as nama_penyewa',
                    'penyewaan.id as id_penyewaan',
                    'penyewaan.tanggal_mulai',
                    'penyewaan.tanggal_selesai',
                    'penyewaan.status_penyewaan',
                    'pembayaran_penyewaan.status_pembayaran',
                    'pembayaran_penyewaan.metode',
                    'produk.id as id_produk',
                    'produk.foto_depan',
                    'produk.nama'
                )
                ->where('penyewa.id', $id_user_decrypt);

            if ($filter && $filter != 'Semua') {
                $query->where(function ($query) use ($filter) {
                    $query->where('penyewaan.status_penyewaan', $filter);
                });
            } else {
                $query->where(function ($query) {
                    $query->where('penyewaan.status_penyewaan', 'Pengembalian')
                        ->orWhere('penyewaan.status_penyewaan', 'Selesai');
                });
            }

            if ($search) {
                $query->where('users.name', 'like', '%' . $search . '%');
            }

            $data = $query->get();

            // Membuat koleksi baru untuk hasil akhir
            $result = collect();

            $seenUsers = [];

            foreach ($data as $item) {
                if (!isset($seenUsers[$item->id_user_penyewa])) {
                    $first_product = DB::table('detail_penyewaan')
                        ->join('produk', 'detail_penyewaan.id_produk', '=', 'produk.id')
                        ->where('detail_penyewaan.id_penyewaan', $item->id_penyewaan)
                        ->select('produk.id as id_produk', 'produk.foto_depan', 'produk.nama')
                        ->first();

                    if ($first_product) {
                        $item->id_produk = $first_product->id_produk;
                        $item->foto_depan = $first_product->foto_depan;
                        $item->nama = $first_product->nama;
                    }

                    $result->push($item);
                    $seenUsers[$item->id_user_penyewa] = true;
                }
            }

            // Jika permintaan dari AJAX, kirim JSON response
            if ($request->ajax()) {
                return response()->json(['data' => $result]);
            }

            return view('customers.menu-transaksi.selesai-order')->with([
                'title' => 'Order Selesai',
                'id_user' => $id_user_decrypt,
                'data' => $result,
                'search' => $search,
            ]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function orderOffline()
    {
        return view('customers.transaksi-offline.offline-transaksi')->with([
            'title' => 'Order Offline'
        ]);
    }

    public function detailOffline()
    {
        return view('customers.transaksi-offline.detail-transaksi')->with([
            'title' => 'Detail Order Offline'
        ]);
    }

    public function tambahTransaksi()
    {
        return view('customers.transaksi-offline.tambah-transaksi')->with([
            'title' => 'Tambah Transaksi Offline'
        ]);
    }
}
