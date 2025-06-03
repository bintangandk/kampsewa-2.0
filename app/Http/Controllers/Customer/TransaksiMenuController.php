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
use Illuminate\Support\Facades\Auth;

class TransaksiMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('cust');
    }
    public function index(Request $request, $id_user)
    {
        $id_user_decrypt = Crypt::decrypt($id_user);

        // Ambil parameter filter dari request
        $filter_tanggal_awal = $request->query('tanggal_awal');
        $filter_tanggal_awal = $filter_tanggal_awal ? date('Y-m-d', strtotime($filter_tanggal_awal)) : null;
        $filter_tanggal_akhir = $request->query('tanggal_akhir');
        $filter_tanggal_akhir = $filter_tanggal_akhir ? date('Y-m-d', strtotime($filter_tanggal_akhir)) : null;
        $search = $request->query('search');

        // Bangun query penyewaan dengan relasi yang diperlukan
        $penyewaanQuery = Penyewaan::with('details', 'pembayaran')->whereHas('details.produk', function ($query) use ($id_user_decrypt) {
            $query->where('id_user', $id_user_decrypt);
        })
            ->with(['details.produk', 'user', 'pembayaran'])
            ->where('status_penyewaan', 'Pending');

        // Filter berdasarkan rentang tanggal jika ada
        // Filter berdasarkan rentang tanggal jika ada
        if ($filter_tanggal_awal && $filter_tanggal_akhir) {
            $penyewaanQuery->whereBetween('tanggal_mulai', [$filter_tanggal_awal, $filter_tanggal_akhir]);
        } elseif ($filter_tanggal_awal) {
            $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_awal);
        } elseif ($filter_tanggal_akhir) {
            $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_akhir);
        }


        // Filter berdasarkan nama penyewa jika ada
        if ($search) {
            $penyewaanQuery->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        // Eksekusi query dan ambil hasilnya
        $penyewaan = $penyewaanQuery->get();

        // Jika permintaan dari AJAX, kirim JSON response
        if ($request->ajax()) {
            return response()->json(['data' => $penyewaan]);
        }


        // dump($id_user_decrypt);

        return view('customers.menu-transaksi.home-transaksi')->with([
            'title' => 'Order Masuk',
            'id_user' => $id_user_decrypt,
            'data' => $penyewaan,
            'search' => $search,
        ]);
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
                'pembayaran_penyewaan.biaya_admin',
                'pembayaran_penyewaan.kurang_pembayaran'
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
                'detail_penyewaan.subtotal',
                'detail_penyewaan.denda',
                'detail_penyewaan.keterangan_denda',
                'detail_penyewaan.id as id_detail'
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

            if (request()->hasFile('jaminan_sewa')) {
                # code...
                $validatedData = request()->validate([
                    'jumlah_pembayaran' => 'required',
                    'kembalian_pembayaran' => 'required',
                    'kurang_pembayaran' => 'required',
                    'total_pembayaran' => 'required',
                    'jaminan_sewa' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                ]);
            } else {
                $validatedData = request()->validate([
                    'jumlah_pembayaran' => 'required',
                    'kembalian_pembayaran' => 'required',
                    'kurang_pembayaran' => 'required',
                    'total_pembayaran' => 'required',
                ]);
            }



            $pembayaran_penyewaan = PembayaranPenyewaan::where('id_penyewaan', $id_penyewaan)->first();

            if (request()->hasFile('jaminan_sewa')) {
                $jaminanSewa = request()->file('jaminan_sewa');
                $jaminanSewaName = time() . '_jaminan.' . $jaminanSewa->getClientOriginalExtension();
                $jaminanSewa->move(public_path('assets/image/customers/jaminan/'), $jaminanSewaName);

                // Tambahkan nama file ke array data yang akan diupdate
                $validatedData['jaminan_sewa'] = $jaminanSewaName;
                $pembayaran_penyewaan->jaminan_sewa = $jaminanSewaName;
            }
            // Proses upload file jaminan
            $total_pembayaran = 0;
            if (request()->has('denda')) {

                foreach (request('denda') as $id_detail => $dendaData) {
                    $dendaValue = (int) str_replace(['Rp.', ' ', '.'], '', $dendaData['denda']); // Bersihkan format Rupiah
                    $keterangan = request('keterangan')[$id_detail] ?? null;
                    // dump($id_detail);
                    if ($dendaValue > 0) {
                        DetailPenyewaan::where('id', $id_detail)->update([
                            'denda' => $dendaValue,
                            'keterangan_denda' => $keterangan,
                        ]);
                    }
                }


                $detail_ = DetailPenyewaan::where('id_penyewaan', $id_penyewaan)->get();
                foreach ($detail_ as $item) {
                    $total_pembayaran += $item->subtotal;
                }
                $total_denda = (int) str_replace(['Rp.', ' ', '.'], '', request('total_denda'));
                $pembayaran_penyewaan->total_denda = $total_denda;
                $pembayaran_penyewaan->total_pembayaran = $total_pembayaran  + $total_denda;
            }


            // Tentukan status pembayaran
            $pembayaran_penyewaan->status_pembayaran = $validatedData['kurang_pembayaran'] > 0 ? 'Belum Lunas' : 'Lunas';

            // Update langsung dengan query builder
            // PembayaranPenyewaan::where('id_penyewaan', $id_penyewaan)->update($validatedData);

            $pembayaran_penyewaan->jumlah_pembayaran = (int) str_replace(['Rp.', ' ', '.'], '', $validatedData['jumlah_pembayaran']);
            $pembayaran_penyewaan->kembalian_pembayaran = (int) str_replace(['Rp.', ' ', '.'], '', $validatedData['kembalian_pembayaran']);
            // $total_denda = (int) str_replace(['Rp.', ' ', '.'], '', $validatedData['total_denda']);

            // $pembayaran_penyewaan->total_pembayaran = $pembayaran_penyewaan->total_pembayaran +
            $pembayaran_penyewaan->kurang_pembayaran = (int) str_replace(['Rp.', ' ', '.'], '', $validatedData['kurang_pembayaran']);
            $pembayaran_penyewaan->save();
            // dd($pembayaran_penyewaan);
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
            } elseif ($parameter == 2) {
                $penyewaan = Penyewaan::where('id', $id_penyewaan)->update(['status_penyewaan' => 'Ditolak']);
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
                    Alert::toast('Order berhasil ditolak!', 'success');
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

        // Ambil parameter filter dari request
        $filter_tanggal_awal = $request->query('tanggal_awal');
        $filter_tanggal_awal = $filter_tanggal_awal ? date('Y-m-d', strtotime($filter_tanggal_awal)) : null;
        $filter_tanggal_akhir = $request->query('tanggal_akhir');
        $filter_tanggal_akhir = $filter_tanggal_akhir ? date('Y-m-d', strtotime($filter_tanggal_akhir)) : null;
        $search = $request->query('search');

        // Bangun query penyewaan dengan relasi yang diperlukan
        $penyewaanQuery = Penyewaan::with('details', 'pembayaran')->whereHas('details.produk', function ($query) use ($id_user_decrypt) {
            $query->where('id_user', $id_user_decrypt);
        })
            ->with(['details.produk', 'user', 'pembayaran'])
            ->where('status_penyewaan', 'Aktif');

        // Filter berdasarkan rentang tanggal jika ada
        // Filter berdasarkan rentang tanggal jika ada
        if ($filter_tanggal_awal && $filter_tanggal_akhir) {
            $penyewaanQuery->whereBetween('tanggal_mulai', [$filter_tanggal_awal, $filter_tanggal_akhir]);
        } elseif ($filter_tanggal_awal) {
            $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_awal);
        } elseif ($filter_tanggal_akhir) {
            $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_akhir);
        }


        // Filter berdasarkan nama penyewa jika ada
        if ($search) {
            $penyewaanQuery->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        // Eksekusi query dan ambil hasilnya
        $penyewaan = $penyewaanQuery->get();

        // Jika permintaan dari AJAX, kirim JSON response
        if ($request->ajax()) {
            return response()->json(['data' => $penyewaan]);
        }
        // dd($penyewaan);
        // Kirim data ke view
        return view('customers.menu-transaksi.sewa-berlangsung')->with([
            'title' => 'Sewa Berlangsung',
            'id_user' => $id_user_decrypt,
            'data' => $penyewaan,
            'search' => $search,
        ]);
    }
    public function sewaditolak($id_user, Request $request)
    {
        // Decrypt id_user
        $id_user_decrypt = Crypt::decrypt($id_user);

        // Ambil parameter filter dari request
        $filter_tanggal_awal = $request->query('tanggal_awal');
        $filter_tanggal_awal = $filter_tanggal_awal ? date('Y-m-d', strtotime($filter_tanggal_awal)) : null;
        $filter_tanggal_akhir = $request->query('tanggal_akhir');
        $filter_tanggal_akhir = $filter_tanggal_akhir ? date('Y-m-d', strtotime($filter_tanggal_akhir)) : null;
        $search = $request->query('search');

        // Bangun query penyewaan dengan relasi yang diperlukan
        $penyewaanQuery = Penyewaan::with('details', 'pembayaran')->whereHas('details.produk', function ($query) use ($id_user_decrypt) {
            $query->where('id_user', $id_user_decrypt);
        })
            ->with(['details.produk', 'user', 'pembayaran'])
            ->where('status_penyewaan', 'Ditolak');

        // Filter berdasarkan rentang tanggal jika ada
        // Filter berdasarkan rentang tanggal jika ada
        if ($filter_tanggal_awal && $filter_tanggal_akhir) {
            $penyewaanQuery->whereBetween('tanggal_mulai', [$filter_tanggal_awal, $filter_tanggal_akhir]);
        } elseif ($filter_tanggal_awal) {
            $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_awal);
        } elseif ($filter_tanggal_akhir) {
            $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_akhir);
        }


        // Filter berdasarkan nama penyewa jika ada
        if ($search) {
            $penyewaanQuery->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        // Eksekusi query dan ambil hasilnya
        $penyewaan = $penyewaanQuery->get();

        // Jika permintaan dari AJAX, kirim JSON response
        if ($request->ajax()) {
            return response()->json(['data' => $penyewaan]);
        }

        // dump($result);

        return view('customers.menu-transaksi.sewa-ditolak')->with([
            'title' => 'Sewa Ditolak',
            'id_user' => $id_user_decrypt,
            'data' => $penyewaan,
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

            // Ambil parameter filter dari request
            $filter_tanggal_awal = $request->query('tanggal_awal');
            $filter_tanggal_awal = $filter_tanggal_awal ? date('Y-m-d', strtotime($filter_tanggal_awal)) : null;
            $filter_tanggal_akhir = $request->query('tanggal_akhir');
            $filter_tanggal_akhir = $filter_tanggal_akhir ? date('Y-m-d', strtotime($filter_tanggal_akhir)) : null;
            $search = $request->query('search');

            // Bangun query penyewaan dengan relasi yang diperlukan
            $penyewaanQuery = Penyewaan::with('details', 'pembayaran')->whereHas('details.produk', function ($query) use ($id_user_decrypt) {
                $query->where('id_user', $id_user_decrypt);
            })
                ->with(['details.produk', 'user', 'pembayaran'])
                ->where('status_penyewaan', 'Selesai');

            // Filter berdasarkan rentang tanggal jika ada
            // Filter berdasarkan rentang tanggal jika ada
            if ($filter_tanggal_awal && $filter_tanggal_akhir) {
                $penyewaanQuery->whereBetween('tanggal_mulai', [$filter_tanggal_awal, $filter_tanggal_akhir]);
            } elseif ($filter_tanggal_awal) {
                $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_awal);
            } elseif ($filter_tanggal_akhir) {
                $penyewaanQuery->whereDate('tanggal_mulai', $filter_tanggal_akhir);
            }


            // Filter berdasarkan nama penyewa jika ada
            if ($search) {
                $penyewaanQuery->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            }

            // Eksekusi query dan ambil hasilnya
            $penyewaan = $penyewaanQuery->get();

            // Jika permintaan dari AJAX, kirim JSON response
            if ($request->ajax()) {
                return response()->json(['data' => $penyewaan]);
            }

            return view('customers.menu-transaksi.selesai-order')->with([
                'title' => 'Order Selesai',
                'id_user' => $id_user_decrypt,
                'data' => $penyewaan,
                'search' => $search,
            ]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function orderOffline()
    {
        $dataPenyewaan = Penyewaan::with([
            'pembayaran',
            'details.produk'
        ])
            ->where('jenis_penyewaan', 'offline')
            ->where('status_penyewaan', 'aktif')
            ->latest()
            ->get();

        return view('customers.transaksi-offline.offline-transaksi')->with([
            'title' => 'Order Offline',
            'dataPenyewaan' => $dataPenyewaan
        ]);
    }


    public function detailOffline($id)
    {
        $penyewaan = Penyewaan::with([
            'details.produk',
            'pembayaran',
        ])->findOrFail($id);

        return view('customers.transaksi-offline.detail-transaksi')->with([
            'title' => 'Detail Order Offline',
            'penyewaan' => $penyewaan,
        ]);
    }


    public function tambahTransaksi()
    {
        $produkList = Produk::all();
        return view('customers.transaksi-offline.tambah-transaksi', compact('produkList'))->with([
            'title' => 'Tambah Transaksi Offline',
        ]);
    }


    public function getVarian($id)
    {
        $varian = VariantProduk::where('id_produk', $id)
            ->with('detailVariant') // gunakan nama relasi yang benar
            ->get()
            ->flatMap(function ($variant) {
                return $variant->detailVariant->map(function ($detail) use ($variant) {
                    return [
                        'warna' => $variant->warna,
                        'ukuran' => $detail->ukuran,
                        'harga_sewa' => $detail->harga_sewa,
                    ];
                });
            });

        return response()->json($varian);
    }

    public function tambahTransaksiPost(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validasi dasar
            $request->validate([
                'nama_penyewa' => 'required|string|max:255',
                'alamat' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
                'variants' => 'required|array|min:1',
                'variants.*.produk' => 'required|integer|exists:produk,id',
                'variants.*.sizes' => 'required|array|min:1',
                'variants.*.sizes.*.ukuran' => 'required|string',
                'variants.*.sizes.*.qty' => 'required|integer|min:1',
                'variants.*.sizes.*.subtotal' => 'required|numeric|min:0',

                // Validasi untuk pembayaran
                'jumlah_pembayaran' => 'required|numeric|min:0',
                'total_pembayaran' => 'required|numeric|min:0',
                'biaya_admin' => 'nullable|numeric|min:0',
                'jaminan_sewa' => 'nullable|string|max:255',
                'metode' => 'required|string|max:255',
                'jenis_transaksi' => 'required|string|max:255',
                'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // 1. Simpan ke tabel penyewaan
            $penyewaan = Penyewaan::create([
                'id_user' => Auth::id(),
                'nama_penyewa' => $request['nama_penyewa'],
                'alamat' => $request['alamat'],
                'tanggal_mulai' => $request['tanggal_mulai'],
                'tanggal_selesai' => $request['tanggal_selesai'],
                'pesan' => 'Transaksi Offline',
                'status_penyewaan' => 'aktif',
                'jenis_penyewaan' => 'offline',
            ]);

            // 2. Simpan detail penyewaan
            foreach ($request['variants'] as $variant) {
                $id_produk = $variant['produk'];

                foreach ($variant['sizes'] as $size) {
                    DetailPenyewaan::create([
                        'id_penyewaan' => $penyewaan->id,
                        'id_produk' => $id_produk,
                        'ukuran' => $size['ukuran'],
                        'warna_produk' => $size['warna'],
                        'qty' => $size['qty'],
                        'subtotal' => $size['subtotal'],
                    ]);
                }
            }

            // 3. Upload bukti pembayaran (jika ada)
            $buktiPembayaran = null;
            if ($request->hasFile('bukti_pembayaran')) {
                $buktiPembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
            }

            // 4. Simpan pembayaran
            PembayaranPenyewaan::create([
                'id_penyewaan' => $penyewaan->id,
                'bukti_pembayaran' => $buktiPembayaran,
                'jaminan_sewa' => $request->jaminan_sewa ?? '',
                'jumlah_pembayaran' => $request->jumlah_pembayaran,
                'kembalian_pembayaran' => $request->jumlah_pembayaran - $request->total_pembayaran,
                'biaya_admin' => $request->biaya_admin ?? 0,
                'kurang_pembayaran' => 0,
                'total_pembayaran' => $request->total_pembayaran,
                'metode' => $request->metode,
                'jenis_transaksi' => $request->jenis_transaksi,
                'status_pembayaran' => 'Lunas',
            ]);

            DB::commit();

            return response()->json(['message' => 'Transaksi berhasil ditambahkan'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal menambahkan transaksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function selesaiOrder()
    {
        $penyewaanSelesai = Penyewaan::with([
            'pembayaran',
            'details.produk'
        ])
            ->where('jenis_penyewaan', 'offline')
            ->where('status_penyewaan', 'selesai')
            ->latest()
            ->get();

        return view('customers.transaksi-offline.selesai-transaksi')->with([
            'title' => 'Order Selesai',
            'penyewaanSelesai' => $penyewaanSelesai
        ]);
    }

    public function selesaikanOffline($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $penyewaan->status_penyewaan = 'selesai';
        $penyewaan->save();

        return redirect()->route('transaksi-offline.order-offline')
            ->with('success', 'Terima Barang Berhasil.');
    }
}
