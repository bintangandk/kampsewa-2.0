 <?php

    use App\Http\Controllers\Api\Auth\LoginController;
    use App\Http\Controllers\Api\Auth\LogoutController;
    use App\Http\Controllers\Api\Auth\LupaPassword;
    use App\Http\Controllers\Api\Auth\RegisterController;
    use App\Http\Controllers\Api\ChartWebController;
    use App\Http\Controllers\Api\IklanControlller;
    use App\Http\Controllers\Api\ProductController;
    use App\Http\Controllers\Api\RiwayatPencarianController;
    use App\Http\Controllers\Api\TransaksiController;
    use App\Http\Controllers\Api\UserController;
    use Illuminate\Support\Facades\Route;

    // auth
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);

    // -- chart api web dev
    Route::get('/chart-keuntungan-menu-dashboard', [ChartWebController::class, 'ApiTotalKeuntungan']);
    Route::get('/chart-penghasilan-menu-penghasilan', [ChartWebController::class, 'apiChartMenuPenghasilan']);
    Route::get('/chart-penghasilan-perbulan-menu-penghasilan', [ChartWebController::class, 'apiChartTotalPenghasilanPerbulanSaatIniMenuPenghasilan']);
    Route::get('/chart-perbandingan-pertahun-web-cust/{id_user}', [ChartWebController::class, 'apiPerbandinganPemasukanPertahunWebCust']);
    Route::get('/chart/weekly-income', [ChartWebController::class, 'getWeeklyIncome']);
    Route::get('/chart/monthly-income', [ChartWebController::class, 'getMonthlyIncome']);

    Route::get('/chart/expense-data', [ChartWebController::class, 'getExpenseData']);

    // lupa password api
    Route::post('/lupa-password', [LupaPassword::class, 'verifikasiPhone']);
    Route::post('/lupa-password/verifikasi-otp/{nomor_telephone}', [LupaPassword::class, 'verifikasiOTP']);
    Route::post('/lupa-password/reset-password/{nomor_telephone}', [LupaPassword::class, 'resetPassword']);
    Route::post('/lupa-password/kirim-ulang-otp/{nomor_telephone}', [LupaPassword::class, 'kirimUlangOTP']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // user
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/user/{id_user}', [UserController::class, 'detailUser']);
        Route::post('/user/update-profile/{id_user}', [UserController::class, 'editProfile']);
        Route::get('/user/pemesanan/{id_user}', [UserController::class, 'pemesananUser']);
        Route::post('/user/tambah-alamat', [UserController::class, 'tambahAlamatUser']);
        Route::get('/user/list-alamat/{id_user}', [UserController::class, 'listAlamatUser']);
        Route::get('/user/detail-alamat/{id_alamat}', [UserController::class, 'detailAlamatUser']);
        Route::put('/user/update-alamat/{id_alamat}', [UserController::class, 'updateAlamatUser']);
        Route::delete('/user/delete-alamat/{id_alamat}', [UserController::class, 'deleteAlamatUser']);
        Route::put('/user/update-password/{id_user}', [UserController::class, 'updatePasswordUser']);
        Route::put('/user/update-password/{id_user}', [UserController::class, 'updatePasswordUser']);
        Route::post('/user/tambah-bank/', [UserController::class, 'tambahBank']);
        Route::post('/user/input-store/{id_user}', [UserController::class, 'tambahStore']);

        // product
        Route::get('/produk/produk-rating-tertinggi-limit6', [ProductController::class, 'produkRatingTertinggiLimit6']);
        Route::get('/produk/{kategori?}', [ProductController::class, 'getProdukByFilter']);
        Route::get('/produk/detail-keranjang-produk/{parameter}', [ProductController::class, 'getDetailProdukKeranjang']);
        Route::get('/produk/detail-produk/{parameter}/{id_user}', [ProductController::class, 'getDetailProduct']);

        // iklan
        Route::get('/iklan', [IklanControlller::class, 'getAllIklan']);
        Route::get('/iklan/{identifier}', [IklanControlller::class, 'getDetailIklan']);

        // riwayat pencarian
        Route::post('/riwayat-pencarian/insert/{id_user}', [RiwayatPencarianController::class, 'insert']);
        Route::get('/riwayat-pencarian/show/{id_user}', [RiwayatPencarianController::class, 'show']);
        Route::delete('/riwayat-pencarian/delete/{id_user}', [RiwayatPencarianController::class, 'delete']);

        // transaksi
        Route::post('/transaksi/checkout/{id_user}', [TransaksiController::class, 'checkout']);
        Route::post('/transaksi/pembayaran', [TransaksiController::class, 'pembayaran']);
        Route::get('/transaksi/lokasi-toko', [TransaksiController::class, 'lokasiToko']);
        Route::get('/transaksi/bank-toko', [TransaksiController::class, 'bankToko']);
        Route::get('/riwayat', [TransaksiController::class, 'riwayat']);

        Route::get('/riwayat/rincian-produk', [TransaksiController::class, 'rincianProduk']);
        Route::post('/riwayat/bayar-sekarang', [TransaksiController::class, 'bayarSekarang']);
    });
