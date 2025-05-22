<?php

use App\Http\Controllers\Api\ChartWebController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\DashboardCustController;
use App\Http\Controllers\Customer\IklanController as CustomerIklanController;
use App\Http\Controllers\Customer\KeuanganController;
use App\Http\Controllers\Customer\ProdukController;
use App\Http\Controllers\Customer\SetDataController;
use App\Http\Controllers\Customer\TransaksiMenuController;
use App\Http\Controllers\Developer\DashboardController;
use App\Http\Controllers\Developer\DetailPenggunaController;
use App\Http\Controllers\Developer\IklanController;
use App\Http\Controllers\Developer\InformasiPenggunaController;
use App\Http\Controllers\Developer\KelolaPenggunaMenuController;
use App\Http\Controllers\Developer\LupaPassword;
use App\Http\Controllers\Developer\NotificationController;
use App\Http\Controllers\Developer\PengeluaranController;
use App\Http\Controllers\Developer\PenghasilanController;
use App\Http\Controllers\Developer\Penyewaan;
use App\Http\Controllers\Developer\ProfileController;
use App\Http\Controllers\Developer\RekapKeuanganController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// -- auth route
Route::get('/login', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post("/logout", [AuthController::class, 'logout'])->name('logout');
Route::get('/lupa-password', [LupaPassword::class, 'index'])->name('lupa-password');
Route::post('/lupa-password/send-otp', [LupaPassword::class, 'sendOTP'])->name('lupa-password.send-otp');
Route::get('/lupa-password/check-kode-otp/{nomor_telephone}', [LupaPassword::class, 'indexCheckOTP'])->name('lupa-password.kode-otp');
Route::post('/lupa-password/check-kode-otp/{nomor_telephone}', [LupaPassword::class, 'checkOTP'])->name('lupa-password.check-otp');
Route::post('/lupa-password/kirim-ulang/{nomor_telephone}', [LupaPassword::class, 'kirimUlang'])->name('lupa-password.kirim-ulang');
Route::get('/lupa-password/reset-password/{nomor_telephone}', [LupaPassword::class, 'indexResetPassword'])->name('lupa-password.reset-password');
Route::post('/lupa-password/reset-password/{nomor_telephone}', [LupaPassword::class, 'resetPassword'])->name('lupa-password.change-password');

/*
|--------------------------------------------------------------------------
| Developer Routes
*/

// landing page routes
Route::get('/', [LandingPageController::class, 'halamanBeranda'])->name('landing-page.halaman-beranda');
Route::get('/halaman_destinasi', [LandingPageController::class, 'halaman_destinasi'])->name('landing-page.halaman_destinasi');
Route::get('/halaman_sewabarang', [LandingPageController::class, 'halaman_sewabarang'])->name('landing-page.halaman_sewabarang');
Route::get('/halaman_testimoni', [LandingPageController::class, 'halaman_testimoni'])->name('landing-page.halaman_testimoni');


// -- dashboard menu route
Route::get('/developer/dashboard/home', [DashboardController::class, 'index'])->name('home.index')->middleware('auth');
Route::put('/mark-notification-as-read', [DashboardController::class, 'markNotificationAsRead'])->name('mark-notification-as-read');

// -- notification
Route::get('developer/dashboard/notification', [NotificationController::class, 'index'])->name('notification.index')->middleware('auth');

// -- kelola pengguna
Route::get('developer/dashboard/kelola-pengguna', [KelolaPenggunaMenuController::class, 'index'])->name('kelola-pengguna.index')->middleware('auth');
Route::get('developer/dashboard/kelola-pengguna/detail-pengguna/{fullname}', [DetailPenggunaController::class, 'index'])->name('detail-pengguna.index')->middleware('auth');
Route::get('developer/dashboard/kelola-pengguna/detail-pengguna/{fullname}/produk-disewakan', [DetailPenggunaController::class, 'showProdukDisewakan'])->name('detail-pengguna.produk-disewakan')->middleware('auth');
Route::get('developer/dashboard/kelola-pengguna/detail-pengguna/{fullname}/produk-disewakan/detail-produk/{namaproduk}', [DetailPenggunaController::class, 'showDetaiwelProdukDisewakan'])->name('detail-pengguna.detail-produk-disewakan')->middleware('auth');
Route::get('developer/dashboard/kelola-pengguna/detail-pengguna/{fullname}/detail-produk-sedang-disewa/{namaproduk}', [DetailPenggunaController::class, 'showDetailProdukSedangDisewa'])->name('detail-pengguna.detail-produk-sedang-disewa')->middleware('auth');
Route::post('/delete-selected-products', [DetailPenggunaController::class, 'deleteSelectedProducts'])->name('delete_selected_products')->middleware('auth');
Route::get('developer/dashboard/informasi-pengguna', [InformasiPenggunaController::class, 'index'])->name('informasi-pengguna.index')->middleware('auth');

Route::get('developer/edit_profile', [InformasiPenggunaController::class, 'editProfile'])->name('edit_profile')->middleware('auth');
Route::post('developer/edit_profile/update_profile', [InformasiPenggunaController::class, 'updateProfile'])->name('update_profile')->middleware('auth');

// iklan
Route::get('developer/dashboard/iklan', [IklanController::class, 'index'])->name('iklan.index')->middleware('auth');
Route::delete('developer/dashboard/iklan/delete-iklan-pending/{id_iklan}', [IklanController::class, 'deleteIklanPending'])->name('iklan.delete-iklan-pending')->middleware('auth');

Route::get('developer/dashboard/penyewaan', [Penyewaan::class, 'index'])->name('penyewaan.index')->middleware('auth');
Route::get('developer/dashboard/penghasilan', [PenghasilanController::class, 'index'])->name('penghasilan.index')->middleware('auth');

Route::get('developer/dashboard/report/pending', [ReportController::class, 'index'])->name('report.index')->middleware('auth');
Route::get('developer/dashboard/report/tolak', [ReportController::class, 'report_tolak'])->name('report.tolak')->middleware('auth');
Route::get('developer/dashboard/report/terima', [ReportController::class, 'report_terima'])->name('report.terima')->middleware('auth');
Route::post('developer/dashboard/report/update_report', [ReportController::class, 'verifikasi'])->name('verifikasi_report')->middleware('auth');
Route::get('developer/dashboard/report/detail_penyewaan_report/{id_penyewaan}/{status}', [ReportController::class, 'detail_penyewaan_report'])->name('detail_report')->middleware('auth');


Route::get('developer/dashboard/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index')->middleware('auth');
Route::post('developer/dashboard/keuangan/tambah-pengeluaran/{id_user}', [PengeluaranController::class, 'tambahPengeluaran'])->name('keuangan.tambah-pengeluaran-developer')->middleware('auth');
Route::post('developer/dashboard/keuangan/update-pengeluaran', [PengeluaranController::class, 'updatePenghasilan'])->name('keuangan.update-pengeluaran-developer')->middleware('auth');

Route::get('/developer/dashboard/keuangan/hapus-pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'hapusPengeluaran'])->name('keuangan.hapus-pengeluaran-developer')->middleware('auth');
Route::get('developer/dashboard/rekap-keuangan', [RekapKeuanganController::class, 'index'])->name('rekap-keuangan.index')->middleware('auth');
Route::get('developer/dashboard/profile/{nama_lengkap}', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');


// -- customer route
Route::get('/customer/dashboard/home', [DashboardCustController::class, 'index'])->name('dashboard-cust')->middleware('auth');

//-- produk
Route::get('/customer/dashboard/menu-produk/{id_user}', [ProdukController::class, 'index'])->name('menu-produk.index')->middleware('auth');
Route::get('/customer/dashboard/kelola-produk/{id_user}', [ProdukController::class, 'kelolaProduk'])->name('menu-produk.kelola-produk')->middleware('auth');
Route::get('/customer/dashboard/kelola-produk/detail-produk/{nama_produk}/{id_user}', [ProdukController::class, 'detailProduk'])->name('menu-produk.detail_produk')->middleware('auth');
Route::get('/customer/dashboard/kelola-produk/tambah-produk/{id_user}', [ProdukController::class, 'tambahProduk'])->name('menu-produk.tambah-produk')->middleware('auth');
Route::get('/customer/dashboard/kelola-produk/update-produk/{id_produk}/{id_user}', [ProdukController::class, 'updateProduk'])->name('menu-produk.update-produk')->middleware('auth');
Route::post('/customer/dashboard/kelola-produk/tambah-produk-post', [ProdukController::class, 'tambahProdukPost'])->name('menu-produk.tambah-produk-post')->middleware('auth');
Route::put('/customer/dashboard/kelola-produk/update-produk-put/{id_produk}', [ProdukController::class, 'updateProdukPut'])->name('menu-produk.update-produk-put')->middleware('auth');
Route::get('/customer/dashboard/sedang-disewa/{id_user}', [ProdukController::class, 'sedangDisewa'])->name('menu-produk.sedang-disewa')->middleware('auth');
Route::delete('/customer/dashboard/delete-produk/{id_produk}', [ProdukController::class, 'deleteProduk'])->name('menu-produk.delete')->middleware('auth');
Route::get('/customer/dashboard/detail-produk/{id_produk}', [ProdukController::class, 'detailProduk'])->name('menu-produk.detail-produk')->middleware('auth');


// iklan
Route::get('/customer/dashboard/buat-iklan/{id_user}', [CustomerIklanController::class, 'index'])->name('buat-iklan.index')->middleware('auth');
Route::get('/customer/dashboard/kelola-iklan/{id_user}', [CustomerIklanController::class, 'kelolaIklan'])->name('kelola-iklan.index')->middleware('auth');
Route::get('/customer/dashboard/kelola-iklan/update-iklan/{id_iklan}', [CustomerIklanController::class, 'updateIklanView'])->name('kelola-iklan.update-iklan-view')->middleware('auth');
Route::put('/customer/dashboard/kelola-iklan/update-iklan-post/{id_iklan}/{id_user}', [CustomerIklanController::class, 'updateIklan'])->name('kelola-iklan.update-iklan-post')->middleware('auth');
Route::get('/customer/dashboard/pilih-durasi-iklan/{id_user}', [CustomerIklanController::class, 'pilihDurasiIklan'])->name('pilih-durasi-iklan.index')->middleware('auth');
Route::get('/customer/dashboard/layanan-iklan/{id_user}/{harga_iklan}', [CustomerIklanController::class, 'layananIklan'])->name('layanan-iklan.index')->middleware('auth');
Route::post('/customer/dashboard/layanan-iklan/{id_user}/{harga_iklan}/{durasi}', [CustomerIklanController::class, 'simpanIklan'])->name('layanan-iklan.simpan-iklan')->middleware('auth');
Route::get('/customer/dashboard/input-pembayaran-iklan/{id_user}/{harga_iklan}/{durasi}', [CustomerIklanController::class, 'inputPembayaranIklan'])->name('input-pembayaran-iklan.index')->middleware('auth');
Route::post('/customer/dashboard/simpan-pembayaran-iklan/{id_user}', [CustomerIklanController::class, 'simpanPembayaranIklan'])->name('simpan-pembayaran-iklan.simpan')->middleware('auth');
Route::delete('/delete-kelola-iklan/{id_iklan}', [CustomerIklanController::class, 'deleteKelolaIklan'])->name('kelola-iklan.delete')->middleware('auth');

// keuangan laporan
Route::get('/customer/dashboard/keuangan/{id_user}', [KeuanganController::class, 'index'])->name('keuangan.index')->middleware('auth');
Route::post('/customer/dashboard/keuangan/tambah-penghasilan/{id_user}', [KeuanganController::class, 'tambahPenghasilan'])->name('keuangan.tambah-penghasilan')->middleware('auth');
Route::get('/customer/dashboard/keuangan/update-penghasilan/{id_penghasilan}', [KeuanganController::class, 'updatePenghasilan'])->name('keuangan.update-penghasilan')->middleware('auth');
Route::put('/customer/dashboard/keuangan/update-penghasilan-post/{id_penghasilan}/{id_user}', [KeuanganController::class, 'updatePenghasilanPost'])->name('keuangan.update-penghasilan-post')->middleware('auth');
Route::get('/download-pdf-penghasilan/{id_user}/{tahun}', [KeuanganController::class, 'downloadPenghasilan'])->name('keuangan.download-penghasilan')->middleware('auth');
Route::delete('/customer/dashboard/keuangan/delete-penghasilan/{id_penghasilan}/', [KeuanganController::class, 'deletePenghasilan'])->name('keuangan.delete-penghasilan')->middleware('auth');

Route::get('/customer/dashboard/keuangan/pengeluaran/{id_user}', [KeuanganController::class, 'pengeluaran'])->name('keuangan.pengeluaran-customer')->middleware('auth');
Route::post('/customer/dashboard/keuangan/tambah-pengeluaran/{id_user}', [KeuanganController::class, 'tambahPengeluaran'])->name('keuangan.tambah-pengeluaran-customer')->middleware('auth');
Route::get('/customer/dashboard/keuangan/update-pengeluaran/{id_pengeluaran}', [KeuanganController::class, 'updatePengeluaran'])->name('keuangan.update-pengeluaran-customer')->middleware('auth');
Route::put('/customer/dashboard/keuangan/update-pengeluaran-post/{id_pengeluaran}/{id_user}', [KeuanganController::class, 'updatePengeluaranPost'])->name('keuangan.update-pengeluaran-post-customer')->middleware('auth');
Route::get('/download-pdf-pengeluaran/{id_user}/{tahun}', [KeuanganController::class, 'downloadPengeluaran'])->name('keuangan.download-pengeluaran-customer')->middleware('auth');
Route::delete('/customer/dashboard/keuangan/delete-pengeluaran/{id_pengeluaran}', [KeuanganController::class, 'deletePengeluaran'])->name('keuangan.delete-pengeluaran-customer')->middleware('auth');

// transaksi
Route::get('customer/dashboard/transaksi/{id_user}', [TransaksiMenuController::class, 'index'])->name('menu-transaksi.index')->middleware('auth');
Route::get('customer/dashboard/sewa-berlangsung/{id_user}', [TransaksiMenuController::class, 'sewaBerlangsung'])->name('menu-transaksi.sewa-berlangsung')->middleware('auth');
Route::get('customer/dashboard/sewa-ditolak/{id_user}', [TransaksiMenuController::class, 'sewaditolak'])->name('menu-transaksi.sewa-ditolak')->middleware('auth');
Route::get('customer/dashboard/denda-transaksi/{id_user}', [TransaksiMenuController::class, 'dendaTransaksi'])->name('menu-transaksi.denda-transaksi')->middleware('auth');
Route::get('customer/dashboard/order-selesai/{id_user}', [TransaksiMenuController::class, 'orderSelesai'])->name('menu-transaksi.order-selesai')->middleware('auth');
Route::get('customer/dashboard/transaksi/terima-order-masuk/{id_penyewaan}', [TransaksiMenuController::class, 'terimaOrderMasuk'])->name('menu-transaksi.terima-order-masuk')->middleware('auth');
Route::put('customer/dashboard/transaksi/input-pembayaran-cod/{id_penyewaan}', [TransaksiMenuController::class, 'inputPembayaranCOD'])->name('menu-transaksi.input-pembayaran-cod')->middleware('auth');
Route::put('customer/dashboard/transaksi/confirm-order-masuk/{id_penyewaan}/{id_user}/{parameter}', [TransaksiMenuController::class, 'confirmOrderMasuk'])->name('menu-transaksi.confirm-order-masuk')->middleware('auth');

//transaksi offline
Route::get('customer/dashboard/order-offline', [TransaksiMenuController::class, 'orderOffline'])->name('transaksi-offline.order-offline')->middleware('auth');
Route::get('customer/dashboard/detail-offline', [TransaksiMenuController::class, 'detailOffline'])->name('transaksi-offline.detail-transaksi')->middleware('auth');
Route::get('customer/dashboard/transaksi-offline', [TransaksiMenuController::class, 'tambahTransaksi'])->name('transaksi-offline.tambah-transaksi')->middleware('auth');
Route::get('customer/dashboard/order-selesai', [TransaksiMenuController::class, 'selesaiOrder'])->name('transaksi-offline.order-selesai')->middleware('auth');
Route::get('/developer/dashboard/keuangan/export-pengeluaran', [PengeluaranController::class, 'exportPengeluaranDeveloperPdf'])->name('developer.export.pengeluaran');
