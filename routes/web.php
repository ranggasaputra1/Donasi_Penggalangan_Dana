<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AdminKuisionerController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\VerifikasiAkunController;
use App\Http\Controllers\MidtransCallbackController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Halaman Utama */

Route::get('/', [LandingController::class, "index"]);
Route::get('/cari', [LandingController::class, 'cari'])->name('cari');
Route::post('/logout', [DashboardController::class, "logout"]);
/* Campaign */
Route::get('/campaign/{slug}', [CampaignController::class, "index"]);
Route::get('/campaign/{slug}/berita/{slugberita}', [CampaignController::class, "berita"]);
/* Kategori */
Route::get('/kategori/{kategori}', [LandingController::class, "kategori"]);
/* Blog */
Route::get('/blog', [BlogController::class, "blogview"]);
Route::get('/blog/{slug}', [BlogController::class, "blogviewdetail"]);
/* Login & Register */
Route::get('/login', [LoginController::class, "index"])->middleware('guest');
Route::post('/login', [LoginController::class, "login"])->name('login');
Route::get('/auth/google/redirect', [SocialiteController::class, "redirecttogoogle"]);
Route::get('/auth/google/callback', [SocialiteController::class, "handlegooglecallback"]);
Route::get('/register', [RegisterController::class, "index"])->middleware('guest');
Route::post('/register', [RegisterController::class, "register"])->name('register');
/* Lupa Password */
Route::get('/lupa-password', [ForgotPasswordController::class, "forgotpassword"]);
Route::post('/lupa-password', [ForgotPasswordController::class, "createtoken"]);
Route::get('/reset-password/{token}', [ForgotPasswordController::class, "resetpassword"])->name('reset-password');
Route::post('/reset-password', [ForgotPasswordController::class, "sendresetpassword"]);
/* Verifikasi Email */
Route::get('/verifikasi/{token}', [VerifikasiAkunController::class, "verifikasiakun"])->name('verifikasi-akun');
/* Callback Midtrans */
Route::post('/transaksi/callback', [MidtransCallbackController::class, 'receive']);

 // Rute untuk halaman donasi publik
    Route::get('/donasi', [CampaignController::class, 'showCampaignsForDonors'])->name('donasi.index');

    // Rute untuk halaman detail campaign donasi
    Route::get('/donasi/{slug}', [CampaignController::class, 'showCampaignDetail'])->name('donasi.detail');

    // Rute untuk memproses donasi
    Route::post('/donasi/store', [CampaignController::class, 'storeDonation'])->name('donasi.store');

    // Rute untuk halaman konfirmasi pembayaran donasi
    Route::get('/donasi/konfirmasi/{id}', [CampaignController::class, 'showConfirmationPage'])->name('donasi.konfirmasi');

    // Rute untuk memproses unggahan bukti transfer
    Route::post('/donasi/upload-bukti/{id}', [CampaignController::class, 'uploadProof'])->name('donasi.upload.proof');

    // Rute untuk halaman riwayat donasi donatur
    Route::get('/donasi-saya', [CampaignController::class, 'showDonorRiwayatDonasi'])->name('donasi.riwayat');


    Route::get('/kuisioner', [KuisionerController::class, 'form']);
    Route::post('/kuisioner', [KuisionerController::class, 'submit']);


/* Dashboard Admin */
Route::group(['middleware' => ['auth', 'role:0']], function () {
    /* Dashboard Admin */
    Route::get('/admin', [DashboardController::class, "admin"])->name('dashboard-admin');
    Route::get('/admin/profil', [DashboardController::class, "profileadmin"]);
    Route::post('/admin/profil-update', [DashboardController::class, "updateprofileadmin"]);
    Route::post('/admin/password-update', [DashboardController::class, "updatepasswordadmin"]);
    
   Route::get('/admin/donatur', [DonaturController::class, 'donatur']);
    Route::get('/admin/donatur/detail/{id}', [DonaturController::class, 'detail']);
    Route::get('/admin/donatur/edit/{id}', [DonaturController::class, 'edit']);
    Route::post('/admin/donatur/update', [DonaturController::class, 'update']);
    Route::post('/admin/donatur/hapus', [DonaturController::class, 'hapus']);


    Route::post('/admin/donatur/hapus', [DonaturController::class, 'hapus']);
    Route::get('/admin/pegawai', [PegawaiController::class, "pegawai"]);

    Route::get('/admin/penggalang-dana/kuisioner', [AdminKuisionerController::class, 'index']);
    Route::get('/admin/penggalang-dana/kuisioner/acc/{id}/{status}', [AdminKuisionerController::class, 'acc']);
    Route::get('/admin/penggalang-dana/kuisioner/detail/{id}', [AdminKuisionerController::class, 'detail']);

    
    Route::post('/admin/penggalang-dana/edit-status-verifikasi-akun', [VerifikasiAkunController::class, "editstatusverifikasi"]);
    Route::post('/admin/pegawai/tambah-pegawai', [PegawaiController::class, "tambahpegawai"]);
    Route::post('/admin/pegawai/hapus-pegawai', [PegawaiController::class, "deletepegawai"]);


    Route::get('/admin/campaign/campaign', [CampaignController::class, 'campaign']);
    Route::post('/admin/campaign/campaign/create', [CampaignController::class, 'createCampaign'])->name('campaign.create');
    Route::post('/admin/campaign/campaign/edit', [CampaignController::class, 'editCampaign'])->name('campaign.edit'); // Tambahkan rute ini untuk update
    Route::post('/admin/campaign/campaign/edit-status-campaign', [CampaignController::class, 'editstatuscampaign']);
    Route::get('/admin/campaign/campaign/delete/{id}', [CampaignController::class, 'deletecampaign']);
    Route::get('/admin/campaign/campaign/lihat/{id}', [CampaignController::class, 'lihatcampaign']);
    Route::get('/admin/campaign/get-penggalang-dana/{id}', [CampaignController::class, 'getPenggalangDanaData']);
    

   
    Route::get('/admin/campaign/berita', [CampaignController::class, "news"]);
    Route::get('/admin/campaign/berita/tambah-berita', [CampaignController::class, "tambahnews"]);
    Route::post('/admin/campaign/berita/tambah-berita/upload-gambar', [CampaignController::class, "uploadgambar"])->name('upload-gambar-berita');
    Route::post('/admin/campaign/berita/post-tambah-berita', [CampaignController::class, "posttambahberita"]);
    Route::get('/admin/campaign/berita/edit-berita/{id}', [CampaignController::class, "editnews"]);
    Route::post('/admin/campaign/berita/post-edit-berita', [CampaignController::class, "posteditberita"]);
    Route::post('/admin/campaign/berita/hapus-berita', [CampaignController::class, "deleteberita"]);

    Route::get('/admin/campaign/kategori', [CampaignController::class, "kategori"]);
    Route::post('/admin/campaign/kategori/tambah-kategori', [CampaignController::class, "tambahkategori"]);
    Route::post('/admin/campaign/kategori/hapus-kategori', [CampaignController::class, "deletekategori"]);

    /* Admin Transaksi */
    Route::get('/admin/transaksi-donasi', [TransaksiController::class, "transaksi"]);
     // Rute untuk mengonfirmasi transaksi
    Route::post('/admin/transaksi/confirm', [CampaignController::class, 'confirmTransaksi'])->name('transaksi.confirm');


    // Rute untuk halaman riwayat donasi admin
    Route::get('/admin/riwayat-donasi', [CampaignController::class, 'riwayatDonasiAdmin'])->name('admin.riwayat.donasi');


    /* Admin Blog */
    Route::get('/admin/artikel-blog', [BlogController::class, "blog"]);
    Route::post('/admin/hapus-artikel', [BlogController::class, "deleteartikel"])->name('hapus-artikel');
    Route::get('/admin/tambah-artikel', [BlogController::class, "tambahartikel"]);
    Route::post('/admin/tambah-artikel/upload-gambar', [BlogController::class, "uploadgambar"])->name('upload-gambar-artikel');
    Route::post('/admin/post-tambah-artikel', [BlogController::class, "posttambahartikel"]);
    Route::get('/admin/edit-artikel/{id}', [BlogController::class, "editartikel"]);
    Route::post('/admin/post-edit-artikel', [BlogController::class, "posteditartikel"]);});


Route::group(['middleware' => ['auth', 'role:1,2']], function () {
    /* Campaign & Donasi */
    Route::get('/campaign-saya', [CampaignController::class, "mycampaign"]);
    /* Buat Campaign */
    // Route::get('/buat-campaign', [CampaignController::class, "buatcampaigndonatur"]);
    Route::post('/buat-campaign', [CampaignController::class, "createcampaigndonatur"]);
    Route::post('/upload-gambar-campaign', [CampaignController::class, "uploadgambarcampaign"])->name('upload-gambar-campaign');
    /* Verifikasi Akun */
    Route::get('/verifikasi-akun/{id}', [VerifikasiAkunController::class, "verifikasiakunktp"]);
    Route::post('/kirim-verifikasi-akun', [VerifikasiAkunController::class, "kirimverifikasiakunktp"]);
    /* Profil */
    Route::get('/profil', [DashboardController::class, "profileuser"]);
    Route::post('/profil-update', [DashboardController::class, "updateprofileuser"]);
    Route::post('/password-update', [DashboardController::class, "updatepassworduser"]);
    /* Transaksi Donasi */
    Route::post('/donasi', [TransaksiController::class, "create"]);
    Route::get('/checkout/{id}', [TransaksiController::class, "checkout"]);
});
