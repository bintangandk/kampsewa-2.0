<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\DetailVariantProduk;
use App\Models\Produk;
use App\Models\RatingProduk;
use App\Models\User;
use App\Models\VariantProduk;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('cust');
    }
    public function index($id_user)
    {
        try {
            // decrypt id user
            $id_user_decrypt = Crypt::decrypt($id_user);

            // variable filter
            $search = request()->query('search');
            $filter_side = request()->query('filter_side');
            $filter_right = request()->query('filter_right');

            // ambil semua data produk berdasarkan id user
            $table_produk = Produk::leftJoin('variant_produk', 'produk.id', '=', 'variant_produk.id_produk')
                ->leftJoin('detail_variant_produk', 'variant_produk.id', '=', 'detail_variant_produk.id_variant_produk')
                ->select(
                    'produk.id as id_produk',
                    'produk.id_user as id_user',
                    'produk.nama as nama_produk',
                    'produk.kategori as kategori_produk',
                    'produk.foto_depan',
                    'produk.created_at',
                    DB::raw('SUM(detail_variant_produk.stok) as stok_produk'),
                    DB::raw('MAX(detail_variant_produk.harga_sewa) as harga_sewa_max'),
                    DB::raw('MIN(detail_variant_produk.harga_sewa) as harga_sewa_min'),
                )
                ->where('produk.id_user', $id_user_decrypt);

            // Apply search filter
            if ($search) {
                $table_produk->where('produk.nama', 'like', '%' . $search . '%');
            }

            // Apply additional filter logic for filter_side if needed
            if ($filter_side) {
                $table_produk->where('produk.kategori', $filter_side);
            }

            // Apply sorting logic for filter_right if needed
            if ($filter_right) {
                if ($filter_right === 'terbaru') {
                    $table_produk->orderBy('produk.created_at', 'desc');
                } elseif ($filter_right === 'terlama') {
                    $table_produk->orderBy('produk.created_at', 'asc');
                } elseif ($filter_right === 'termahal') {
                    $table_produk->orderBy('harga_sewa_max', 'desc');
                } elseif ($filter_right === 'termurah') {
                    $table_produk->orderBy('harga_sewa_min', 'asc');
                }
            }

            // Paginate the filtered results
            $result_table = $table_produk->groupBy('produk.id', 'produk.id_user', 'produk.nama', 'produk.kategori', 'produk.foto_depan', 'produk.created_at')->paginate(32);

            return view('customers.menu-produk.produk')->with([
                'title' => 'Produk Menu | KampSewa',
                'produk' => $result_table,
                'search' => $search,
                'result' => '',
                'filter_side' => $filter_side,
                'filter_right' => $filter_right,
            ]);
        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }


    public function kelolaProduk($id_user)
    {
        $id = Crypt::decrypt($id_user);

        $search = request()->query('search');

        // Create the base query
        $base_query = Produk::leftJoin('variant_produk', 'produk.id', '=', 'variant_produk.id_produk')
            ->leftJoin('detail_variant_produk', 'variant_produk.id', '=', 'detail_variant_produk.id_variant_produk')
            ->select(
                'produk.id as id_produk',
                'produk.id_user as id_user',
                'produk.nama as nama_produk',
                'produk.status as status_produk',
                'produk.foto_depan as foto',
                DB::raw('SUM(detail_variant_produk.stok) as stok_produk')
            )->where('produk.id_user', $id);

        // Clone the base query to count the total number of products
        $count_query = clone $base_query;

        if ($search) {
            $base_query->where(function ($query) use ($search) {
                $query->where('produk.nama', 'LIKE', "%{$search}%")
                    ->orWhere('produk.status', $search);
            });
            $count_query->where(function ($query) use ($search) {
                $query->where('produk.nama', 'LIKE', "%{$search}%")
                    ->orWhere('produk.status', $search);
            });
        }

        // Apply group by to the main query
        $data_produk = $base_query->groupBy('produk.id', 'produk.id_user', 'produk.nama', 'produk.status', 'produk.foto_depan');

        // Get the results
        $produk_result = $data_produk->paginate(50);

        // Count the total number of products
        $total_product = $count_query->count();

        return view('customers.menu-produk.kelola-produk')->with(
            [
                'title' => 'Kelola Produk | KampSewa',
                'produk' => $produk_result,
                'search' => $search,
                'total_produk' => $total_product,
            ]
        );
    }


    public function sedangDisewa($id_user)
    {
        return view('customers.menu-produk.sedang-disewa', ['title' => 'Sedang Disewa | KampSewa']);
    }
    public function tambahProduk($id_user)
    {
        $id_user_dec = Crypt::decrypt($id_user);
        return view('customers.menu-produk.tambah-produk')->with([
            'title' => 'Tambah Produk',
            'id' => $id_user_dec,
        ]);
    }

    public function tambahProdukPost(Request $request)
    {
        try {
            // Validasi data jika diperlukan
            $request->validate([
                'id_user' => 'required|string',
                'nama_produk' => 'required|string|max:100',
                'deskripsi_produk' => 'required|string|max:1000',
                'kategori_produk' => 'required|string',
                'foto_depan' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000',
                'foto_belakang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
                'foto_kiri' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
                'foto_kanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
                'variants.*.warna' => 'nullable|string',
                'variants.*.sizes.*.ukuran' => 'nullable|string',
                'variants.*.sizes.*.stok' => 'nullable|integer',
                'variants.*.sizes.*.harga_sewa' => 'nullable|integer',
            ]);

            $request->merge([
                'status' => 'Tersedia',
            ]);

            // Simpan data produk
            $produk = new Produk();
            $produk->id_user = $request->input('id_user');
            $produk->nama = $request->input('nama_produk');
            $produk->deskripsi = $request->input('deskripsi_produk');
            $produk->kategori = $request->input('kategori_produk');

            // Simpan gambar-gambar
            if ($request->hasFile('foto_depan')) {
                $foto_depan = $request->file('foto_depan');
                $fotoDepanName = time() . '_depan.' . $foto_depan->getClientOriginalExtension();
                $foto_depan->move(public_path('assets/image/customers/produk/'), $fotoDepanName);
                $produk->foto_depan = $fotoDepanName;
            }

            if ($request->hasFile('foto_belakang')) {
                $foto_belakang = $request->file('foto_belakang');
                $fotoBelakangName = time() . '_belakang.' . $foto_belakang->getClientOriginalExtension();
                $foto_belakang->move(public_path('assets/image/customers/produk/'), $fotoBelakangName);
                $produk->foto_belakang = $fotoBelakangName;
            }

            if ($request->hasFile('foto_kiri')) {
                $foto_kiri = $request->file('foto_kiri');
                $fotoKiriName = time() . '_kiri.' . $foto_kiri->getClientOriginalExtension();
                $foto_kiri->move(public_path('assets/image/customers/produk/'), $fotoKiriName);
                $produk->foto_kiri = $fotoKiriName;
            }

            if ($request->hasFile('foto_kanan')) {
                $foto_kanan = $request->file('foto_kanan');
                $fotoKananName = time() . '_kanan.' . $foto_kanan->getClientOriginalExtension();
                $foto_kanan->move(public_path('assets/image/customers/produk/'), $fotoKananName);
                $produk->foto_kanan = $fotoKananName;
            }

            $produk->save();

            // Simpan detail varian produk
            foreach ($request->variants as $variant) {
                $varian = new VariantProduk();
                $varian->id_produk = $produk->id;
                $varian->warna = $variant['warna'];
                $varian->save();

                foreach ($variant['sizes'] as $size) {
                    $detailVarian = new DetailVariantProduk();
                    $detailVarian->id_variant_produk = $varian->id;
                    if ($size['ukuran'] === null) {
                        $size['ukuran'] = 'Belum di isi';
                    }
                    $detailVarian->ukuran = $size['ukuran'];
                    $detailVarian->stok = $size['stok'];
                    $detailVarian->harga_sewa = $size['harga_sewa'];
                    $detailVarian->save();
                }
            }

            Alert::toast('Data berhasil disimpan', 'success');
            return back();
        } catch (\Exception $e) {
            // Tangani pengecualian di sini
            Alert::toast('Terjadi kesalahan, harap check inputan anda kembali!', 'warning');
            Log::error('Error: ' . $e->getMessage());
            return back();
        }
    }

    public function deleteProduk($id_produk)
    {
        try {
            $table_produk = Produk::where('id', $id_produk);
            if (!$table_produk) {
                Alert::toast('Gagal menghapus produk coba lagi nanti!', 'warning');
                return back();
            }
            $table_produk->delete();
            Alert::toast('Produk berhasil dihapus!', 'success');
            return back();
        } catch (\Exception $error) {
            Log::error('Error : ' . $error->getMessage());
        }
    }

    public function detailProduk($id_product)
    {
        $id_product_decrypt = Crypt::decrypt($id_product);

        // Mengambil detail produk bersama dengan rata-rata rating dan jumlah ulasan
        $product_detail = Produk::join('variant_produk', 'produk.id', '=', 'variant_produk.id_produk')
            ->leftJoin('rating_produk', 'produk.id', '=', 'rating_produk.id_produk')
            ->select(
                'produk.id as id_produk',
                'produk.nama as nama_produk',
                'produk.status as status_produk',
                'produk.deskripsi as deskripsi_produk',
                'produk.kategori as kategori_produk',
                'produk.foto_depan',
                'produk.foto_belakang',
                'produk.foto_kiri',
                'produk.foto_kanan',
                DB::raw('AVG(rating_produk.rating) as rata_rating'),
            )
            ->where('produk.id', $id_product_decrypt)
            ->groupBy(
                'produk.id',
                'produk.nama',
                'produk.status',
                'produk.deskripsi',
                'produk.kategori',
                'produk.foto_depan',
                'produk.foto_belakang',
                'produk.foto_kiri',
                'produk.foto_kanan'
            )
            ->first();

        // Mengambil detail varian
        $variant_details = VariantProduk::join('detail_variant_produk', 'variant_produk.id', '=', 'detail_variant_produk.id_variant_produk')
            ->select(
                'variant_produk.warna',
                'detail_variant_produk.ukuran',
                'detail_variant_produk.stok',
                'detail_variant_produk.harga_sewa'
            )
            ->where('variant_produk.id_produk', $id_product_decrypt)
            ->get();

        // Konversi warna dari bahasa Indonesia ke bahasa Inggris
        $color_translation = [
            'merah' => 'red',
            'biru' => 'blue',
            'hijau' => 'green',
            'kuning' => 'yellow',
            'hitam' => 'black',
            'putih' => 'white',
            'jingga' => 'orange',
            'abu-abu' => 'gray',
            'coklat' => 'brown',
            'ungu' => 'purple',
            'pink' => 'pink',
            'emas' => 'gold',
            'perak' => 'silver',
            'tosca' => 'teal',
            'navy' => 'navy',
            'peach' => 'peach',
            'marun' => 'maroon',
            'hijau muda' => 'light green',
            'hijau tua' => 'dark green',
            'biru muda' => 'light blue',
            'biru tua' => 'dark blue',
            'kuning muda' => 'light yellow',
            'kuning tua' => 'dark yellow',
            'merah muda' => 'light red',
            'merah tua' => 'dark red',
            'ungu muda' => 'light purple',
            'ungu tua' => 'dark purple',
            'coklat muda' => 'light brown',
            'coklat tua' => 'dark brown'
        ];


        // Terapkan konversi warna dan lowercase
        $translated_variant_details = $variant_details->map(function ($item) use ($color_translation) {
            $warna_lowercase = strtolower($item->warna);
            if (isset($color_translation[$warna_lowercase])) {
                $item->warna = $color_translation[$warna_lowercase];
            }
            return $item;
        })->groupBy('warna');

        $rating = $product_detail->rata_rating ?? 0;

        // Mendapatkan data rating produk
        $ratings = RatingProduk::where('id_produk', $id_product_decrypt)->get();

        $userRatings = RatingProduk::join('users', 'rating_produk.id_user', '=', 'users.id')
            ->select('rating_produk.*', 'users.name as user_name', 'users.foto')
            ->where('rating_produk.id_produk', $id_product_decrypt)
            ->get();

        $total_ulasan = RatingProduk::join('users', 'rating_produk.id_user', '=', 'users.id')
            ->select('rating_produk.*', 'users.name as user_name')
            ->where('rating_produk.id_produk', $id_product_decrypt)
            ->count();

        return view('customers.menu-produk.detail-produk')->with([
            'title' => 'Detail Produk',
            'detail_produk' => $product_detail,
            'variant_details' => $translated_variant_details,
            'rating' => $rating,
            'userRatings' => $userRatings,
            'total_ulasan' => $total_ulasan,
        ]);
    }



    public function updateProduk($id_produk, $id_user)
    {
        // Decrypt the ids
        $id_produk_decrypt = Crypt::decrypt($id_produk);
        $id_user_decrypt = Crypt::decrypt($id_user);

        // Retrieve the product, variants, and detail variants
        $table_produk = Produk::where('id', $id_produk_decrypt)
            ->where('id_user', $id_user_decrypt)
            ->first();

        $table_variant_produk = VariantProduk::where('id_produk', $id_produk_decrypt)->get();

        $table_detail_variant_produk = DetailVariantProduk::whereIn('id_variant_produk', $table_variant_produk->pluck('id'))
            ->get()
            ->groupBy('id_variant_produk');

        // Pass data to the view
        return view('customers.menu-produk.update-produk')->with([
            'title' => 'Update Produk',
            'id_produk' => $id_produk_decrypt,
            'id_user' => $id_user_decrypt,
            'produk' => $table_produk,
            'variants' => $table_variant_produk,
            'detail_variants' => $table_detail_variant_produk,
        ]);
    }

    public function updateProdukPut($id_produk, Request $request)
    {

        // dd($request->all());
        // Validasi data input
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'kategori_produk_update' => 'required|string|max:255',
            'foto_depan' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'foto_belakang' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'foto_kiri' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'foto_kanan' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'variants' => 'required|array',
            'variants.*.warna' => 'required|string|max:255',
            'variants.*.sizes' => 'nullable|array',
            'variants.*.sizes.*.ukuran' => 'required|string|max:255',
            'variants.*.sizes.*.stok' => 'required|integer|min:0',
            'variants.*.sizes.*.harga_sewa' => 'required|integer|min:0',
        ]);

        // Update data produk
        $produk = Produk::findOrFail($id_produk);
        $produk->nama = $validatedData['nama_produk'];
        $produk->deskripsi = $validatedData['deskripsi_produk'];
        $produk->kategori = $request['kategori_produk_update'];

        // try {
        // Log::info('Kategori Produk: ' . $request->input('kategori_produk_update'));

        // Handle foto uploads
        $fotoFields = ['foto_depan', 'foto_belakang', 'foto_kiri', 'foto_kanan'];
        foreach ($fotoFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/image/customers/produk/'), $filename);
                $produk->$field = $filename; // Menggunakan $filename bukan $filePath
            }
        }

        $produk->save();

        // dd($produk->kategori);


        // Sinkronisasi varian dan detail varian
        $existingVariantIds = [];
        foreach ($request->input('variants') as $variantData) {
            $variant = VariantProduk::updateOrCreate(
                ['id_produk' => $id_produk, 'warna' => $variantData['warna']],
                ['warna' => $variantData['warna']]
            );
            $existingVariantIds[] = $variant->id;

            $existingDetailVariantIds = [];
            if (isset($variantData['sizes'])) {
                foreach ($variantData['sizes'] as $detailVariantData) {
                    $detailVariant = DetailVariantProduk::updateOrCreate(
                        ['id_variant_produk' => $variant->id, 'ukuran' => $detailVariantData['ukuran']],
                        [
                            'ukuran' => $detailVariantData['ukuran'],
                            'stok' => $detailVariantData['stok'],
                            'harga_sewa' => $detailVariantData['harga_sewa']
                        ]
                    );
                    $existingDetailVariantIds[] = $detailVariant->id;
                }
            }

            // Hapus detail varian yang tidak ada di input
            DetailVariantProduk::where('id_variant_produk', $variant->id)
                ->whereNotIn('id', $existingDetailVariantIds)
                ->delete();
        }

        // Hapus varian yang tidak ada di input
        VariantProduk::where('id_produk', $id_produk)
            ->whereNotIn('id', $existingVariantIds)
            ->delete();

        Alert::toast('Produk berhasil di update!', 'success');
        return back();
        // } catch (\Exception $error) {
        //     Log::error('Error :' . $error->getMessage());
        // }
    }
}
