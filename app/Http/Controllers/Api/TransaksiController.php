<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Bank;
use App\Models\DetailPenyewaan;
use App\Models\DetailVariantProduk;
use App\Models\Pemasukan;
use App\Models\PembayaranPenyewaan;
use App\Models\Penyewaan;
use App\Models\Produk;
use App\Models\User;
use App\Models\VariantProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Switch_;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function checkout($id_user)
    {
        try {
            $message_error = [
                'tanggal_mulai.required' => 'Tanggal mulai wajib diisi.',
                'tanggal_mulai.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
                'tanggal_selesai.required' => 'Tanggal selesai wajib diisi.',
                'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
                'pesan.string' => 'Pesan harus berupa teks.',
                'pesan.max' => 'Pesan tidak boleh lebih dari 255 karakter.',
                'produk_details.required' => 'Detail produk wajib diisi.',
                'produk_details.array' => 'Detail produk harus berupa array.',
                'produk_details.*.id_produk.required' => 'ID produk wajib diisi.',
                'produk_details.*.id_produk.integer' => 'ID produk harus berupa angka.',
                'produk_details.*.warna.required' => 'Warna produk wajib diisi.',
                'produk_details.*.warna.string' => 'Warna produk harus berupa teks.',
                'produk_details.*.ukuran.required' => 'Ukuran produk wajib diisi.',
                'produk_details.*.ukuran.string' => 'Ukuran produk harus berupa teks.',
                'produk_details.*.qty.required' => 'Jumlah produk wajib diisi.',
                'produk_details.*.qty.integer' => 'Jumlah produk harus berupa angka.',
                'produk_details.*.subtotal.required' => 'Subtotal wajib diisi.',
                'produk_details.*.subtotal.integer' => 'Subtotal harus berupa angka.',
            ];

            request()->validate([
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'pesan' => 'nullable|string|max:255',
                'produk_details' => 'required|array',
                'produk_details.*.id_produk' => 'required|integer',
                'produk_details.*.warna' => 'required|string',
                'produk_details.*.ukuran' => 'required|string',
                'produk_details.*.qty' => 'required|integer',
                'produk_details.*.subtotal' => 'required|integer',
                'metode' => 'required|string',
                'biaya_admin' => 'required|integer',
            ], $message_error);

            // Mengisi tabel penyewaan
            $table_penyewaan = new Penyewaan();
            $table_penyewaan->id_user = $id_user;
            $table_penyewaan->tanggal_mulai = request()->input('tanggal_mulai');
            $table_penyewaan->tanggal_selesai = request()->input('tanggal_selesai');
            $table_penyewaan->pesan = request()->input('pesan') ?: 'Tidak ada pesan';
            $table_penyewaan->status_penyewaan = 'Pending';
            $table_penyewaan->save();

            if (request()->input('metode') == 'COD') {
                $table_pembayaran = new PembayaranPenyewaan();
                $table_pembayaran->id_penyewaan = $table_penyewaan->id;
                $table_pembayaran->bukti_pembayaran = 'Belum di isi';
                $table_pembayaran->jaminan_sewa = 'Belum di isi';
                $table_pembayaran->jumlah_pembayaran = 0;
                $table_pembayaran->kembalian_pembayaran = 0;
                $table_pembayaran->biaya_admin = request()->input('biaya_admin');
                $table_pembayaran->kurang_pembayaran = 0;
                $table_pembayaran->total_pembayaran = 0;
                $table_pembayaran->metode = request()->input('metode');
                $table_pembayaran->save();
            }

            // Mengisi tabel detail_penyewaan
            $produk_details = request()->input('produk_details');

            foreach ($produk_details as $detail) {
                $table_detail_penyewaan = new DetailPenyewaan();
                $table_detail_penyewaan->id_penyewaan = $table_penyewaan->id;
                $table_detail_penyewaan->id_produk = $detail['id_produk'];
                $table_detail_penyewaan->warna_produk = $detail['warna'];
                $table_detail_penyewaan->ukuran = $detail['ukuran'];
                $table_detail_penyewaan->qty = $detail['qty'];
                $table_detail_penyewaan->subtotal = $detail['subtotal'];
                $table_detail_penyewaan->save();

                // Mengurangi stok produk di tabel detail_variant_produk
                $detail_variant_produk = DetailVariantProduk::join('variant_produk', 'detail_variant_produk.id_variant_produk', '=', 'variant_produk.id')
                    ->where('variant_produk.id_produk', $detail['id_produk'])
                    ->where('variant_produk.warna', $detail['warna'])
                    ->where('detail_variant_produk.ukuran', $detail['ukuran'])
                    ->select('detail_variant_produk.*')
                    ->first();

                if ($detail_variant_produk) {
                    $detail_variant_produk->stok -= $detail['qty'];
                    $detail_variant_produk->save();
                } else {
                    return response()->json([
                        'message' => 'Varian produk tidak ditemukan',
                        'id_produk' => $detail['id_produk'],
                        'warna' => $detail['warna'],
                        'ukuran' => $detail['ukuran']
                    ], 404);
                }
            }

            $detail_penyewaan = DetailPenyewaan::where('id_penyewaan', $table_penyewaan->id)->get();

            return response()->json([
                'message' => 'success',
                'penyewaan' => $table_penyewaan,
                'detail_penyewaan' => $detail_penyewaan,
            ], 200);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }

    public function pembayaran(Request $request)
    {
        $id_toko = $request->query('id_toko');

        try {
            $validate = Validator::make($request->all(), [
                'id_penyewaan' => 'required|integer',
                'bukti_pembayaran' => 'required|image|mimes:png,jpg|max:3000',
                'jaminan_sewa' => 'required|image|mimes:png,jpg|max:3000',
                'jumlah_pembayaran' => 'required|integer',
                'kembalian_pembayaran' => 'required|integer',
                'biaya_admin' => 'required|integer',
                'kurang_pembayaran' => 'required|integer',
                'total_pembayaran' => 'required|integer',
            ]);

            if ($validate->fails()) {
                return response()->json(['message' => $validate->errors()], 400);
            }

            $request->merge([
                'metode' => 'Transfer',
                'status_pembayaran' => 'Lunas',
                'jenis_transaksi' => 'Ambil ditempat',
            ]);

            $pembayaran = new PembayaranPenyewaan($request->all());

            if ($request->hasFile('bukti_pembayaran')) {
                $buktiPembayaran = $request->file('bukti_pembayaran');
                $buktiPembayaranName = time() . '_bukti.' . $buktiPembayaran->getClientOriginalExtension();
                $buktiPembayaran->move(public_path('assets/image/customers/pembayaran/'), $buktiPembayaranName);
                $pembayaran->bukti_pembayaran = $buktiPembayaranName;
            }

            if ($request->hasFile('jaminan_sewa')) {
                $jaminanSewa = $request->file('jaminan_sewa');
                $jaminanSewaName = time() . '_jaminan.' . $jaminanSewa->getClientOriginalExtension();
                $jaminanSewa->move(public_path('assets/image/customers/jaminan/'), $jaminanSewaName);
                $pembayaran->jaminan_sewa = $jaminanSewaName;
            }

            $pembayaran->save();

            if ($id_toko != null) {
                $pemasukanData = [
                    [
                        'id_user' => $id_toko,
                        'sumber' => 'Penyewaan',
                        'deskripsi' => 'Layanan Penyewaan Toko',
                        'nominal' => $request->total_pembayaran,
                    ],
                    [
                        'id_user' => $id_toko,
                        'sumber' => 'Service',
                        'deskripsi' => 'Biaya Admin',
                        'nominal' => $request->biaya_admin,
                    ]
                ];

                foreach ($pemasukanData as $data) {
                    $pemasukan = new Pemasukan($data);
                    $pemasukan->save();
                }
            }

            return response()->json(['message' => 'Pembayaran berhasil disimpan', 'data' => $pembayaran], 201);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan pada server.', 'error' => $error->getMessage()], 500);
        }
    }

    public function lokasiToko()
    {
        $id_user_toko = request()->query('id_user');
        $name_store = request()->query('name_store');
        $id_user_pemesanan = request()->query('id_user_pemesanan');
        $id_alamat_user_pemesanan = request()->query('id_alamat_user');

        if (!$id_user_toko && !$name_store) {
            return response()->json(['error' => 'Harus ada parameter id_user atau name_store'], 400);
        }

        $relation_table = Alamat::join('users', 'users.id', '=', 'alamat.id_user')
            ->select(
                'alamat.id as id_alamat',
                'alamat.longitude',
                'alamat.latitude',
                'alamat.type',
                'alamat.detail_lainnya',
                'users.name as user_name'
            )
            ->where('alamat.type', 1)
            ->where(function ($query) use ($id_user_toko, $name_store) {
                if ($id_user_toko) {
                    $query->where('alamat.id_user', $id_user_toko);
                }
                if ($name_store) {
                    $query->orWhere('users.name', $name_store);
                }
            })
            ->get();

        if ($relation_table->isEmpty()) {
            return response()->json(['error' => 'Tidak ada data yang ditemukan'], 404);
        }

        if ($id_user_pemesanan && $id_alamat_user_pemesanan) {
            $lokasi_pemesanan = Alamat::where('id', $id_alamat_user_pemesanan)
                ->where('id_user', $id_user_pemesanan)
                ->first();

            if (!$lokasi_pemesanan) {
                return response()->json(['error' => 'Lokasi pemesanan tidak ditemukan'], 404);
            }

            $relation_table->transform(function ($item) {
                $address = $this->getAddressFromCoordinates($item->latitude, $item->longitude);
                $item->address = $address;
                return $item;
            });

            $relation_table = $relation_table->map(function ($item) use ($lokasi_pemesanan) {
                $distance_km = $this->calculateDistance($lokasi_pemesanan->latitude, $lokasi_pemesanan->longitude, $item->latitude, $item->longitude);
                $item->jarak_km = round($distance_km, 2);
                $item->jarak_mil = round($distance_km * 0.621371, 2);
                return $item;
            })->sortBy('jarak_km');

            $nearest_location = $relation_table->first();

            return response()->json([
                'message' => 'success',
                'lokasi_toko' => $nearest_location,
            ]);
        } else {
            $relation_table->transform(function ($item) {
                $address = $this->getAddressFromCoordinates($item->latitude, $item->longitude);
                $item->address = $address;
                return $item;
            });

            return response()->json([
                'message' => 'success',
                'lokasi_toko' => $relation_table,
            ]);
        }
    }

    private function getAddressFromCoordinates($latitude, $longitude)
    {
        $response = Http::get("https://nominatim.openstreetmap.org/reverse", [
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json'
        ]);
        $data = $response->json();
        if ($response->successful() && isset($data['display_name'])) {
            return $data['display_name'];
        }
        return 'Address not found';
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earth_radius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earth_radius * $c;
        return $distance;
    }

    public function bankToko()
    {
        $id_user = request()->query('id_user');
        $name_store = request()->query('name_store');

        $bank = Bank::select('bank.id', 'bank.id_user', 'bank.rekening', DB::raw('UPPER(bank.bank) as bank'))
            ->where(function ($query) use ($id_user, $name_store) {
                if ($id_user) {
                    $query->where('id_user', $id_user);
                }
                if ($name_store) {
                    $query->orWhere('name_store', $name_store);
                }
            })
            ->get();

        return response()->json([
            'message' => 'success',
            'bank' => $bank,
        ]);
    }

    public function riwayat(Request $request)
    {
        try {
            // Validasi parameter
            $tipe_riwayat = $request->query('tipe_riwayat');
            $id_user = $request->query('id_user');
            
            if (!$tipe_riwayat || !$id_user) {
                return response()->json([
                    'message' => 'error',
                    'error' => 'Parameter tipe_riwayat dan id_user wajib diisi!'
                ], 400);
            }

            $validTipeRiwayat = ['belum-bayar', 'pengambilan', 'berlangsung', 'selesai', 'dibatalkan'];
            if (!in_array($tipe_riwayat, $validTipeRiwayat)) {
                return response()->json([
                    'message' => 'error',
                    'error' => 'Invalid tipe_riwayat. Harus salah satu dari: ' . implode(', ', $validTipeRiwayat)
                ], 400);
            }

            // Query utama untuk penyewaan
            $penyewaans = Penyewaan::with([
                    'pembayaran',
                    'details' => function($query) {
                        $query->orderBy('id')
                              ->with(['produk.storeUser', 'produk.ratings']);
                    }
                ])
                ->where('id_user', $id_user)
                ->where(function($query) use ($tipe_riwayat) {
                    $this->applyStatusFilter($query, $tipe_riwayat);
                })
                ->orderBy('created_at', 'desc')
                ->get();

            // Format response
            $responseData = $this->formatResponseData($penyewaans);

            return response()->json([
                'message' => 'success',
                'response' => $responseData
            ], 200);

        } catch (\Exception $error) {
            Log::error('Riwayat API Error: ' . $error->getMessage());
            return response()->json([
                'message' => 'error',
                'error' => 'Terjadi kesalahan server. Silakan coba lagi nanti.'
            ], 500);
        }
    }

    private function applyStatusFilter($query, $tipe_riwayat)
    {
        switch ($tipe_riwayat) {
            case 'belum-bayar':
                $query->where('status_penyewaan', 'Pending')
                      ->whereHas('pembayaran', function($q) {
                          $q->where('status_pembayaran', 'Belum lunas');
                      });
                break;
            case 'pengambilan':
                $query->where('status_penyewaan', 'Pending')
                      ->whereHas('pembayaran', function($q) {
                          $q->where('status_pembayaran', 'Lunas');
                      });
                break;
            case 'berlangsung':
                $query->where('status_penyewaan', 'Aktif')
                      ->whereHas('pembayaran', function($q) {
                          $q->where('status_pembayaran', 'Lunas');
                      });
                break;
            case 'selesai':
                $query->where('status_penyewaan', 'Selesai')
                      ->whereHas('pembayaran', function($q) {
                          $q->where('status_pembayaran', 'Lunas');
                      });
                break;
            case 'dibatalkan':
                $query->where('status_penyewaan', 'Dibatalkan');
                break;
        }
    }

    private function formatResponseData($penyewaans)
    {
        return $penyewaans->map(function($penyewaan) {
            $firstDetail = $penyewaan->details->first();
            if (!$firstDetail) return null;
            
            $produk = $firstDetail->produk;
            $storeUser = $produk->storeUser;

            // Hitung rating rata-rata dari semua produk dalam penyewaan
            $rating = $penyewaan->details->flatMap(function($detail) {
                return $detail->produk->ratings->pluck('rating');
            })->avg();

            return [
                'id' => $penyewaan->id_user,
                'id_penyewaan' => $penyewaan->id,
                'id_detail_penyewaan' => $firstDetail->id,
                'nama_toko' => $storeUser->name_store,
                'nama_produk' => $produk->nama,
                'foto_produk' => $produk->foto_depan,
                'qty' => $firstDetail->qty,
                'deskripsi_produk' => "Size {$firstDetail->ukuran} / Warna {$firstDetail->warna_produk}",
                'ukuran' => $firstDetail->ukuran,
                'warna' => $firstDetail->warna_produk,
                'qty_produk_lain' => $penyewaan->details->count() - 1,
                'rating' => (float) $rating,
                'subtotal_harga' => (float) $firstDetail->subtotal,
                'total_pesanan' => (float) ($penyewaan->pembayaran->total_pembayaran ?? 0),
                'durasi' => $this->calculateDuration($penyewaan->tanggal_mulai, $penyewaan->tanggal_selesai),
                'status_transaksi' => $penyewaan->pembayaran->status_pembayaran ?? 'Belum lunas',
            ];
        })->filter()->values()->toArray();
    }

    private function calculateDuration($startDate, $endDate)
    {
        $days = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
        return "$days Hari";
    }

    public function bayarSekarang(Request $request)
    {
        try {
            $request->validate([
                'bukti_pembayaran' => 'required|image|mimes:png,jpg',
                'jaminan_sewa' => 'required|image|mimes:png,jpg',
                'jumlah_pembayaran' => 'required|integer',
                'total_pembayaran' => 'required|integer',
            ]);

            $id_penyewaan = $request->query('id_penyewaan');
            $pembayaran_penyewaan = PembayaranPenyewaan::where('id_penyewaan', $id_penyewaan)->first();

            if (!$pembayaran_penyewaan) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $update = [
                'jumlah_pembayaran' => $request->input('jumlah_pembayaran'),
                'total_pembayaran' => $request->input('total_pembayaran'),
                'metode' => 'Transfer',
                'status_pembayaran' => 'Lunas',
            ];

            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $destinationPath = public_path('assets/image/customers/pembayaran/');
                $filename = time() . '_bukti' . $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $foto_url = $filename;
                $update['bukti_pembayaran'] = $foto_url;
            }

            if ($request->hasFile('jaminan_sewa')) {
                $file = $request->file('jaminan_sewa');
                $destinationPath = public_path('assets/image/customers/jaminan/');
                $filename = time() . '_jaminan' . $file->getClientOriginalName();
                $file->move($destinationPath, $filename);
                $foto_url = $filename;
                $update['jaminan_sewa'] = $foto_url;
            }

            $pembayaran_penyewaan->update($update);

            return response()->json([
                'message' => 'Data berhasil diperbarui',
                'data' => $pembayaran_penyewaan,
            ], 200);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return response()->json([
                'message' => 'error',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function rincianRiwayat($id)
    {
        // Ambil data penyewaan dengan relasi yang dibutuhkan
        $penyewaan = Penyewaan::with([
            'pembayaran',
            'details.produk.storeUser.alamat' => function($query) {
                $query->where('type', 1); // Hanya ambil alamat toko (type=1)
            }
        ])->findOrFail($id);

        // Hitung durasi sewa
        $durasi = \Carbon\Carbon::parse($penyewaan->tanggal_mulai)
            ->diffInDays($penyewaan->tanggal_selesai);

        // Format data produk
        $produk = $penyewaan->details->map(function($item) {
            return [
                'nama_produk' => $item->produk->nama,
                'warna' => $item->warna_produk,
                'ukuran' => $item->ukuran,
                'qty' => $item->qty,
                'subtotal' => $item->subtotal
            ];
        });

        // Format response
        $response = [
            'id_penyewaan' => $penyewaan->id,
            'status_penyewaan' => $penyewaan->status_penyewaan,
            'status_pembayaran' => $penyewaan->pembayaran->status_pembayaran,
            'tanggal_mulai' => $penyewaan->tanggal_mulai,
            'tanggal_selesai' => $penyewaan->tanggal_selesai,
            'jenis_transaksi' => $penyewaan->pembayaran->jenis_transaksi,
            'alamat_penjual' => [
                'longitude' => $penyewaan->details->first()->produk->storeUser->alamat->first()->longitude ?? null,
                'latitude' => $penyewaan->details->first()->produk->storeUser->alamat->first()->latitude ?? null
            ],
            'name_store' => $penyewaan->details->first()->produk->storeUser->name_store,
            'produk' => $produk,
            'durasi_sewa' => $durasi,
            'total_bayar' => $penyewaan->pembayaran->total_pembayaran,
            'metode_pembayaran' => $penyewaan->pembayaran->metode,
            'tanggal_pemesanan' => $penyewaan->created_at
        ];

        return response()->json([
            'status' => 'success',
            'data' => $response
        ]);
    }
}
