<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Front_end\HomeController;
use App\Http\Controllers\Front_end\Now_playingController;
use App\Http\Controllers\Front_end\Coming_soonController;
use App\Http\Controllers\Front_end\Sold_outController;
use App\Http\Controllers\Front_end\Daftar_bisnisController;
use App\Http\Controllers\Front_end\Mulai_investasiController;
use App\Http\Controllers\Front_end\SubMenuController;
use App\Http\Controllers\Front_end\ErrorPageController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);
// Route::post('/emiten/store',[App\Http\Controllers\EmitenController::class, 'store']);
Route::group(['middleware' => ['auth', 'checkRole:2', "verified",'pin','KYC']], function () {
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'indexuser']);
    
    Route::get('/user/emiten', [App\Http\Controllers\EmitenController::class, 'index_user']);
    Route::get('/user/bisnis_anda', [App\Http\Controllers\EmitenController::class, 'user_emiten']);
    Route::get('/user/pesan_saham', [App\Http\Controllers\BookSahamController::class, 'index_user']);
    Route::get('/user/pesan_saham/detail/{id}', [App\Http\Controllers\BookSahamController::class, 'detail_user']);

    Route::post('/upload_bukti/{id}', [App\Http\Controllers\BookSahamController::class, 'upload_bukti']);
    Route::get('/penerbit/bisnisdetail/{uuid}', [App\Http\Controllers\EmitenController::class, 'detail_bisnis']);
    Route::post('/user/penerbit/get_riwayat_laporan_keuangan/{uuid}', [App\Http\Controllers\EmitenController::class, 'get_riwayat_laporan_keuangan']);
    Route::post('/penerbit/savePlan/{type}', [App\Http\Controllers\EmitenController::class, 'savePlan']);
    Route::get('/user/laporan-keuangan/getLastReport/{uuid}', [App\Http\Controllers\LaporanKeuanganController::class, 'getLastReport']);
    Route::get('/user/laporan-keuangan/detail/{uuid}/{id}', [App\Http\Controllers\LaporanKeuanganController::class, 'detail']);
    Route::get('/user/laporan-keuangan/detail/{uuid}', [App\Http\Controllers\LaporanKeuanganController::class, 'new_detail']);
    Route::post('/user/laporan-keuangan/delete', [App\Http\Controllers\LaporanKeuanganController::class, 'delete']);
    Route::post('/user/laporan-keuangan/saveReport', [App\Http\Controllers\LaporanKeuanganController::class, 'saveReport']);
    Route::get('/edit_bisnis/{id}', [App\Http\Controllers\EmitenController::class, 'edit_bisnis']);
    Route::post('/update_bisnis/{id}',[App\Http\Controllers\EmitenController::class, 'update_bisnis']);

    Route::get('/edit_profile/{id}',[App\Http\Controllers\TraderController::class, 'edit_profile']);
    Route::post('/update_profile/{id}',[App\Http\Controllers\TraderController::class, 'update_profile']);
    
    Route::get('/user/portfolio',[App\Http\Controllers\TraderController::class, 'portofolio']);
    Route::get('/user/deviden',[App\Http\Controllers\TraderController::class, 'user_deviden']);
    Route::get('/user/riwayat_aktifitas',[App\Http\Controllers\TraderController::class, 'history']);
    Route::get('/user/video_tutorial',[App\Http\Controllers\TraderController::class, 'video']);
    Route::get('/results', [App\Http\Controllers\TraderController::class, 'results'])->name('results');
    Route::get('/watch/{id}', [App\Http\Controllers\TraderController::class, 'watch'])->name('watch');
    
    Route::post('/user/read',[App\Http\Controllers\TraderController::class, 'read_message']);
    Route::post('/user/add_bank',[App\Http\Controllers\TraderController::class, 'add_bank']);
    Route::post('/pin_check',[App\Http\Controllers\TraderController::class, 'pin_check']);

    Route::get('/user/transaksi', [App\Http\Controllers\TransactionsController::class, 'user_transaksi']);
    Route::post('/user/cancel_transaksi', [App\Http\Controllers\TransactionsController::class, 'canceltrx']);
    Route::get('/user/deposit', [App\Http\Controllers\DepositController::class, 'user_depo']);
    Route::get('/user/wallet', [App\Http\Controllers\TraderController::class, 'user_wallet']);
    Route::post('/user/create_deposit', [App\Http\Controllers\DepositController::class, 'user_cdepo']);
    Route::get('/user/penarikan', [App\Http\Controllers\PenarikanController::class, 'user_tarik']);
    Route::post('/user/penarikan/create', [App\Http\Controllers\PenarikanController::class, 'create']);
    Route::get('/transaksi/pembayaran',[App\Http\Controllers\TransactionsController::class, 'checkout']);
    Route::post('/transaksi/buy',[App\Http\Controllers\TransactionsController::class, 'buy_token']);
    Route::get('/user/get-regency', [App\Http\Controllers\AddressController::class, 'usergetRegency']);

    Route::get('/secondary_market', [App\Http\Controllers\TraderController::class, 'secmar']);
    
});

Route::get('pin',[App\Http\Controllers\TraderController::class, 'pinv'])->name('pinv');
Route::post('pin_post',[App\Http\Controllers\TraderController::class, 'pin']);
Route::get('pin_reset',[App\Http\Controllers\TraderController::class, 'pin_reset']);
Route::post('pin_reset_post',[App\Http\Controllers\TraderController::class, 'pin_reset_post']);
Route::get('/login/verify_email/{uuid}',[App\Http\Controllers\TraderController::class, 'email_verify']);
Route::get('/user/forgot-password/reset/{token}', [App\Http\Controllers\TraderController::class, 'mobile_reset']);

Route::get('/upload_transfer/{id}',[App\Http\Controllers\BookSahamController::class, 'pay']);
Route::post('/upload_bukti_user/{id}', [App\Http\Controllers\BookSahamController::class, 'upload_bukti_user']);
Route::group(['middleware' => ['auth', 'checkRole:1', "verified"]], function () {
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'indexadmin']);
    Route::get('/admin/emiten', [App\Http\Controllers\EmitenController::class, 'index']);
    Route::get('/admin/emiten/add', [App\Http\Controllers\EmitenController::class, 'add']);
    Route::post('/emiten/store',[App\Http\Controllers\EmitenController::class, 'store']);
    Route::get('/admin/emiten/edit/{id}', [App\Http\Controllers\EmitenController::class, 'edit']);
    Route::post('/emiten/update/{id}',[App\Http\Controllers\EmitenController::class, 'update']);
    Route::post('/emiten/delete/{id}',[App\Http\Controllers\EmitenController::class, 'delete']);
    Route::post('/emiten/update_status/{id}',[App\Http\Controllers\EmitenController::class, 'emiten_status']);
    Route::get('/emiten/fetch-emiten',[App\Http\Controllers\EmitenController::class, 'fetchEmiten']);
    
    Route::get('/admin/pesan_saham', [App\Http\Controllers\BookSahamController::class, 'index']);
    Route::get('/admin/pesan_saham/add', [App\Http\Controllers\BookSahamController::class, 'create']);
    Route::post('/pesan_saham/store',[App\Http\Controllers\BookSahamController::class, 'store']);
    Route::get('/admin/pesan_saham/detail/{id}', [App\Http\Controllers\BookSahamController::class, 'detail']);
    Route::post('/admin/pesan_saham/approve/{id}', [App\Http\Controllers\BookSahamController::class, 'approve']);
    Route::post('/admin/pesan_saham/reject/{id}', [App\Http\Controllers\BookSahamController::class, 'reject']);
    
    Route::get('/admin/transactions', [App\Http\Controllers\TransactionsController::class, 'index']);
    Route::get('/admin/get_transactions', [App\Http\Controllers\TransactionsController::class, 'fetchData']);
    Route::get('/admin/transaction/detail/{uuid}/{status}', [App\Http\Controllers\TransactionsController::class, 'detail']);
    Route::get('/admin/transaction/confirm/{uuid}', [App\Http\Controllers\TransactionsController::class, 'confirm']);
    Route::get('/admin/transaction/cancel_confirm/{uuid}', [App\Http\Controllers\TransactionsController::class, 'cancelConfirm']);
    Route::post('/admin/transaction/delete_transaction', [App\Http\Controllers\TransactionsController::class, 'deleteTransaction']);
    
    Route::get('/admin/withdraw', [App\Http\Controllers\WithdrawController::class, 'index']);
    Route::get('/admin/get_withdraw', [App\Http\Controllers\WithdrawController::class, 'fetchData']);

    Route::get('/admin/deposit', [App\Http\Controllers\DepositController::class, 'admin_deposit']);
    Route::get('/admin/get_deposit', [App\Http\Controllers\DepositController::class, 'fetchDataAdminDeposit']);
    
    Route::get('/admin/dividen', [App\Http\Controllers\DevidenController::class, 'index']);
    Route::get('/admin/get_dividen', [App\Http\Controllers\DevidenController::class, 'fetchData']);
    Route::get('/admin/detail_dividen', [App\Http\Controllers\DevidenController::class, 'detail']);
    Route::get('/admin/add_dividen', [App\Http\Controllers\DevidenController::class, 'create']);
    Route::post('/admin/generate_dividend', [App\Http\Controllers\DevidenController::class, 'generateDividend']);
    Route::get('/admin/get_dividen_by_uuid', [App\Http\Controllers\DevidenController::class, 'getEmitenByUuid']);
    Route::get('/admin/get_history_dividend', [App\Http\Controllers\DevidenController::class, 'getAdminHistoryDividend']);
    Route::post('/admin/save-generate-dividen', [App\Http\Controllers\DevidenController::class, 'saveGenerateDividen']);
    Route::get('/hapus-session', [App\Http\Controllers\DevidenController::class, 'hapusSession']);

    Route::get('/admin/wallet', [App\Http\Controllers\WalletController::class, 'index']);

    Route::get('/admin/laporan-keuangan', [App\Http\Controllers\LaporanKeuanganController::class, 'index']);
    Route::post('/admin/get-laporan-keuangan', [App\Http\Controllers\LaporanKeuanganController::class, 'getLaporanKeuangan']);
    Route::post('/admin/konfirmasi-laporan-keuangan', [App\Http\Controllers\LaporanKeuanganController::class, 'confirmLaporan']);
    
    Route::get('/admin/crm/target-user', [App\Http\Controllers\CRMController::class, 'viewTargetUser']);
    Route::post('/admin/crm/get-target-user', [App\Http\Controllers\CRMController::class, 'getListUserTarget']);
    Route::get('/admin/crm/add-broadcasting/{id}', [App\Http\Controllers\CRMController::class, 'addBroadcasting']);
    Route::get('/admin/crm/edit-target-user/{id}', [App\Http\Controllers\CRMController::class, 'editTargetUser']);
    Route::get('/admin/crm/target-user-tersedia', [App\Http\Controllers\CRMController::class, 'viewTargetUserTersedia']);
    Route::post('/admin/crm/get-target-user-tersedia', [App\Http\Controllers\CRMController::class, 'getListUserTargetTersedia']);
    Route::get('/admin/crm/add-target-user', [App\Http\Controllers\CRMController::class, 'addTargetUser']);
    Route::post('/admin/crm/get-version', [App\Http\Controllers\CRMController::class, 'getVersion']);
    Route::post('/admin/crm/store-target', [App\Http\Controllers\CRMController::class, 'saveTarget']);
    Route::post('/admin/crm/update-target', [App\Http\Controllers\CRMController::class, 'updateTarget']);
    Route::post('/admin/crm/delete-target/{id}', [App\Http\Controllers\CRMController::class, 'deleteTarget']);
    Route::get('/admin/crm/broadcasting', [App\Http\Controllers\CRMController::class, 'viewListBroadcasting']);
    Route::post('/admin/crm/get-broadcasting', [App\Http\Controllers\CRMController::class, 'getBroadcasting']);
    Route::get('/admin/crm/broadcasting/add', [App\Http\Controllers\CRMController::class, 'viewAddBroadcastiong']);
    Route::get('/admin/crm/broadcasting/edit/{id}', [App\Http\Controllers\CRMController::class, 'editBroadcasting']);
    Route::get('/admin/crm/broadcasting/delete/{id}', [App\Http\Controllers\CRMController::class, 'deleteBroadcasting']);
    Route::post('/admin/crm/save-konten', [App\Http\Controllers\CRMController::class, 'saveKonten']);
    Route::post('/admin/crm/save-publish', [App\Http\Controllers\CRMController::class, 'savePublish']);
    Route::get('/admin/crm/get-category', [App\Http\Controllers\CRMController::class, 'getCategories']);
    Route::get('/admin/crm/detail-broadcasting/{id}', [App\Http\Controllers\CRMController::class, 'detailPreviewBroadcast']);
    
    Route::get('/admin/get-provinsi', [App\Http\Controllers\AddressController::class, 'getProvince']);
    Route::get('/admin/get-regency', [App\Http\Controllers\AddressController::class, 'getRegency']);

    Route::get('/admin/get-push-notif/{id}', [App\Http\Controllers\PushNotificationController::class, 'pushNotif']);
    Route::get('/admin/push-notif/{id}', [App\Http\Controllers\PushNotificationController::class, 'index']);
    Route::post('/admin/broadcast-notif', [App\Http\Controllers\PushNotificationController::class, 'broadcastNotif']);
    
    Route::post('/admin/broadcast-email', [App\Http\Controllers\PushNotificationController::class, 'broadcastEmail']);

    Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/admin/category/store', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::put('/admin/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::post('/admin/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);
    Route::get('/admin/fetch_category', [App\Http\Controllers\CategoryController::class, "fethData"]);

    Route::get('/admin/cms/header', [App\Http\Controllers\HeaderController::class, 'index']);
    Route::get('/admin/cms/header/create', [App\Http\Controllers\HeaderController::class, 'create']);
    Route::get('/admin/cms/header/edit/{id}', [App\Http\Controllers\HeaderController::class, 'edit']);
    Route::post('/admin/cms/header/store', [App\Http\Controllers\HeaderController::class, 'store']);
    Route::post('/admin/cms/header/update/{id}', [App\Http\Controllers\HeaderController::class, 'update']);
    Route::post('/admin/cms/header/delete/{id}', [App\Http\Controllers\HeaderController::class, 'destroy']);

    Route::get('/admin/kyc/belum-kyc', [App\Http\Controllers\NewKycController::class, 'belumKyc']);
    Route::get('/admin/kyc/get-belum-kyc', [App\Http\Controllers\NewKycController::class, 'getBelumKyc']);
    Route::get('/admin/kyc/get-trail-user/{id}', [App\Http\Controllers\NewKycController::class, 'getQueryTrail']);
    Route::get('/admin/kyc/sudah-kyc', [App\Http\Controllers\NewKycController::class, 'sudahKyc']);
    Route::get('/admin/kyc/get-sudah-kyc', [App\Http\Controllers\NewKycController::class, 'getSudahKyc']);
    Route::get('/admin/kyc/approve-kyc/{id}', [App\Http\Controllers\NewKycController::class, 'putApprove']);
    Route::put('/admin/kyc/reject-kyc/{id}', [App\Http\Controllers\NewKycController::class, 'putReject']);
    Route::get('/admin/kyc/approve-kyc', [App\Http\Controllers\NewKycController::class, 'approveKyc']);
    Route::get('/admin/kyc/get-approve-kyc', [App\Http\Controllers\NewKycController::class, 'getApproveKyc']);
    Route::get('/admin/kyc/reject-kyc', [App\Http\Controllers\NewKycController::class, 'rejectKyc']);
    Route::get('/admin/kyc/get-reject-kyc', [App\Http\Controllers\NewKycController::class, 'getRejectKyc']);

    Route::get('/admin/cms/testimoni', [App\Http\Controllers\SuccessStoriesController::class, 'index']);
    Route::get('/admin/cms/testimoni/create', [App\Http\Controllers\SuccessStoriesController::class, 'create']);
    Route::post('/admin/cms/testimoni/store', [App\Http\Controllers\SuccessStoriesController::class, 'store']);
    Route::get('/admin/cms/testimoni/edit/{id}', [App\Http\Controllers\SuccessStoriesController::class, 'edit']);
    Route::post('/admin/cms/testimoni/update/{id}', [App\Http\Controllers\SuccessStoriesController::class, 'update']);
    Route::post('/admin/cms/testimoni/delete/{id}', [App\Http\Controllers\SuccessStoriesController::class, 'destroy']);
    
    Route::get('/admin/cms/supporter', [App\Http\Controllers\SupportersController::class, 'index']);
    Route::get('/admin/cms/supporter/create', [App\Http\Controllers\SupportersController::class, 'create']);
    Route::post('/admin/cms/supporter/store', [App\Http\Controllers\SupportersController::class, 'store']);
    Route::get('/admin/cms/supporter/edit/{id}', [App\Http\Controllers\SupportersController::class, 'edit']);
    Route::post('/admin/cms/supporter/update/{id}', [App\Http\Controllers\SupportersController::class, 'update']);
    Route::post('/admin/cms/supporter/delete/{id}', [App\Http\Controllers\SupportersController::class, 'destroy']);

    Route::get('/admin/cms/shortened', [App\Http\Controllers\ShortenedController::class, 'index']);
    Route::get('/admin/cms/shortened/create', [App\Http\Controllers\ShortenedController::class, 'create']);
    Route::post('/admin/cms/shortened/store', [App\Http\Controllers\ShortenedController::class, 'store']);
    Route::get('/admin/cms/shortened/edit/{id}', [App\Http\Controllers\ShortenedController::class, 'edit']);
    Route::post('/admin/cms/shortened/update/{id}', [App\Http\Controllers\ShortenedController::class, 'update']);
    Route::post('/admin/cms/shortened/delete/{id}', [App\Http\Controllers\ShortenedController::class, 'destroy']);

    Route::get('/admin/cms/popup', [App\Http\Controllers\PopupController::class, 'index']);
    Route::get('/admin/cms/popup/create', [App\Http\Controllers\PopupController::class, 'create']);
    Route::post('/admin/cms/popup/store', [App\Http\Controllers\PopupController::class, 'store']);
    Route::get('/admin/cms/popup/edit/{id}', [App\Http\Controllers\PopupController::class, 'edit']);
    Route::post('/admin/cms/popup/update/{id}', [App\Http\Controllers\PopupController::class, 'update']);
    Route::post('/admin/cms/popup/delete/{id}', [App\Http\Controllers\PopupController::class, 'destroy']);

    Route::get('/admin/cms/video', [App\Http\Controllers\SantaraVideosController::class, 'index']);
    Route::get('/admin/cms/video/create', [App\Http\Controllers\SantaraVideosController::class, 'create']);
    Route::post('/admin/cms/video/store', [App\Http\Controllers\SantaraVideosController::class, 'saveData']);
    Route::get('/admin/cms/video/edit/{id}', [App\Http\Controllers\SantaraVideosController::class, 'edit']);
    Route::post('/admin/cms/video/delete/{id}', [App\Http\Controllers\SantaraVideosController::class, 'destroy']);
    Route::get('/admin/cms/video/set-status/{uuid}/{status}', [App\Http\Controllers\SantaraVideosController::class, 'setStatus']);

    Route::get('/admin/pralisting', [App\Http\Controllers\PralistingController::class, 'index']);
    Route::get('/admin/pralisting/get-pralisting', [App\Http\Controllers\PralistingController::class, 'fetchData']);
    Route::get('/admin/pralisting/konfirmasi/{uuid}', [App\Http\Controllers\PralistingController::class, 'konfirmasi']);
    Route::post('/admin/pralisting/accept-pralisting', [App\Http\Controllers\PralistingController::class, 'acceptPralisting']);
    Route::post('/admin/pralisting/accept-official', [App\Http\Controllers\PralistingController::class, 'acceptpOffice']);
    Route::get('/admin/pralisting/delete/{id}', [App\Http\Controllers\PralistingController::class, 'delete']);

    Route::get('/admin/get-users', [App\Http\Controllers\EmitenController::class, 'getUser']);
    Route::get('/admin/get-categories', [App\Http\Controllers\EmitenController::class, 'getCategories']);

    Route::get('/admin/cms/video-category', [App\Http\Controllers\KategoriVideoController::class, 'index']);
    Route::get('/admin/cms/video-category/add', [App\Http\Controllers\KategoriVideoController::class, 'create']);
    Route::get('/admin/cms/video-category/edit/{id}', [App\Http\Controllers\KategoriVideoController::class, 'edit']);
    Route::post('/admin/cms/video-category/store', [App\Http\Controllers\KategoriVideoController::class, 'saveData']);
    Route::post('/admin/cms/video-category/delete/{id}', [App\Http\Controllers\KategoriVideoController::class, 'destroy']);

    Route::get('/admin/setting/account', [App\Http\Controllers\AccountController::class, 'index']);
    Route::get('/admin/setting/account/get-account', [App\Http\Controllers\AccountController::class, 'fetchData']);
    Route::get('/admin/setting/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit']);
    Route::post('/admin/setting/account/update_user', [App\Http\Controllers\AccountController::class, 'update']);
    Route::get('/admin/setting/account/reset-password/{id}', [App\Http\Controllers\AccountController::class, 'resendEmailReset']);
    Route::post('/admin/setting/account/delete/{id}', [App\Http\Controllers\AccountController::class, 'destroy']);

    Route::get('/admin/export_penerbit', [App\Http\Controllers\HomeController::class, 'exportPenerbit']);
    Route::get('/admin/export_user', [App\Http\Controllers\HomeController::class, 'exportUser']);

    Route::get('/admin/penerbit/setting-tutorial', [App\Http\Controllers\SettingLaporanKeuanganController::class, 'index']);
    Route::post('/admin/penerbit/store_setting_tutor', [App\Http\Controllers\SettingLaporanKeuanganController::class, 'store']);
    Route::get('/admin/pralisting/kyc-bisnis', [App\Http\Controllers\PralistingController::class, 'indexKycBisnis']);
    Route::post('/admin/pralisting/verified-bisnis', [App\Http\Controllers\PralistingController::class, 'verifiedEmitenBisnis']);
    Route::get('/admin/pralisting/flag-now-playing', [App\Http\Controllers\PralistingController::class, 'flagNowPlaying']);
    Route::get('/admin/pralisting/export-calon-penerbit', [App\Http\Controllers\PralistingController::class, 'exportCalonPenerbit']);
    
    Route::get('/admin/member-trader', [App\Http\Controllers\MemberController::class, 'index']);
    Route::get('/admin/member-trader/fetch-data', [App\Http\Controllers\MemberController::class, 'fetchData']);
    Route::get('/admin/member-trader/fetch-portofolio/{userId}', [App\Http\Controllers\MemberController::class, 'portofolio']);
    Route::get('/admin/member-trader/export-investor', [App\Http\Controllers\MemberController::class, 'exportInvestor']);

    Route::get('/admin/kyc/konfirmasi/{uuid}', [App\Http\Controllers\KycController::class, 'konfirmasi']);
    Route::post('/admin/kyc/confirm_url', [App\Http\Controllers\KycController::class, 'confirm']);
    Route::post('/admin/kyc/update_url', [App\Http\Controllers\KycController::class, 'update']);

    Route::get('/admin/withdraw/export-excel', [App\Http\Controllers\WithdrawController::class,'exportExcel']);
    Route::get('/admin/dividen/export-excel', [App\Http\Controllers\DevidenController::class,'exportExcel']);
    Route::get('/admin/transaction/export-excel', [App\Http\Controllers\TransactionsController::class,'exportExcel']);
    Route::get('/admin/deposit/export-excel', [App\Http\Controllers\DepositController::class,'exportExcel']);

    Route::get('/admin/penerbit/perhitungan-dividen', [App\Http\Controllers\PerhitunganDividenController::class, 'index']);
    Route::get('/admin/penerbit/perhitungan-detail', [App\Http\Controllers\PerhitunganDividenController::class, 'detailData']);
    
    Route::get('/admin/kyc/individu/summary-kyc', [App\Http\Controllers\KycController::class, 'summaryKYC']);
    Route::get('/admin/kyc/individu/belum-kyc', [App\Http\Controllers\KycController::class, 'belumKYC']);
    Route::get('/admin/kyc/fetch-belum-kyc', [App\Http\Controllers\KycController::class, 'fetchDataBelumKYC']);
    Route::get('/admin/kyc/individu/pembaruan-kyc', [App\Http\Controllers\KycController::class, 'pembaruanKYC']);
    Route::get('/admin/kyc/fetch-pembaruan-kyc', [App\Http\Controllers\KycController::class, 'fetchDataPembaruanDataKYC']);
    Route::get('/admin/kyc/individu/menunggu-verifikasi-kyc', [App\Http\Controllers\KycController::class, 'menungguVerifikasiKYC']);
    Route::get('/admin/kyc/fetch-menunggu-verifikasi-kyc', [App\Http\Controllers\KycController::class, 'fetchDataMenungguVerifikasiKYC']);
    Route::get('/admin/kyc/individu/ditolak-kyc', [App\Http\Controllers\KycController::class, 'ditolakKYC']);
    Route::get('/admin/kyc/fetch-data-ditolak-kyc', [App\Http\Controllers\KycController::class, 'fetchDataTolakKYC']);
    Route::get('/admin/kyc/individu/terverifikasi-kyc', [App\Http\Controllers\KycController::class, 'terverifikasiKYC']);
    Route::get('/admin/kyc/fetch-data-terverifikasi-kyc', [App\Http\Controllers\KycController::class, 'fetchDataTerverifikasiKYC']);
    
    Route::get('/admin/member-trader/{userid}', [App\Http\Controllers\MemberController::class, 'detailTrader']);

    Route::get('/admin/emiten/pemberitahuan-dividen', [App\Http\Controllers\NotifDividenController::class, 'index']);
    Route::get('/admin/emiten/pemberitahuan-dividen/{id}', [App\Http\Controllers\NotifDividenController::class, 'sendNotif']);
    
    Route::get('/admin/crm/fetch-user-email', [App\Http\Controllers\MemberController::class, 'fetchEmailUser']);
    
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index']);
Route::post('/pesan_saham/store_user',[App\Http\Controllers\BookSahamController::class, 'store_user']);




Route::resource('/now-playing', Now_playingController::class);
Route::resource('/coming-soon', Coming_soonController::class);
Route::resource('/sold-out', Sold_outController::class);
Route::resource('/daftar-bisnis', Daftar_bisnisController::class);
Route::resource('/mulai-investasi', Mulai_investasiController::class);

Route::get('/tentang-santara', [SubMenuController::class, 'tentang'])->name('tentang-santara');
Route::get('/testimoni', [SubMenuController::class, 'testimoni'])->name('testimoni');
Route::get('/pemodal', [SubMenuController::class, 'pemodal'])->name('pemodal');
Route::get('/penerbit', [SubMenuController::class, 'penerbit'])->name('penerbit');
Route::get('/support-by', [SubMenuController::class, 'support'])->name('support-by');
Route::get('/kontak', [SubMenuController::class, 'kontak'])->name('kontak');
Route::get('/pertanyaan', [SubMenuController::class, 'pertanyaan'])->name('pertanyaan');
Route::get('/video', [SubMenuController::class, 'video'])->name('video');
Route::get('/filter-video', [SubMenuController::class, 'filter_video'])->name('video.filter');

Route::get('/error-404', [ErrorPageController::class, 'index'])->name('notfound');

Route::get('/detail-now-playing/{id}', [Now_playingController::class, 'detail'])->name('now-playing.detail');
Route::get('/detail-coming-soon/{id}', [Coming_soonController::class, 'detail'])->name('coming-soon.detail');
Route::get('/detail-sold-out/{id}', [Sold_outController::class, 'detail'])->name('sold-out.detail');
Route::get('/filter-sold-out', [Sold_outController::class, 'filter'])->name('sold-out.filter');
Route::get('/testajaxcs', [Coming_soonController::class, 'testajax']);

Route::group(['middleware' => ['auth', "verified"]], function () {
    Route::get('/daftar-bisnis/create', [Daftar_bisnisController::class, 'create'])->name('daftar-bisnis.create');
    Route::post('/daftar-bisnis/store',[Daftar_bisnisController::class, 'store'])->name('daftar-bisnis.store');
    Route::post('/addLike/{id}',[App\Http\Controllers\EmitenVoteController::class,'addlike']);
    Route::post('/addVote/{id}',[App\Http\Controllers\EmitenVoteController::class,'addvote']);
    Route::post('/addVot/{id}',[App\Http\Controllers\EmitenVoteController::class,'addvot']);
    Route::post('/subLike/{id}',[App\Http\Controllers\EmitenVoteController::class,'sublike']);
    Route::post('/subVote/{id}',[App\Http\Controllers\EmitenVoteController::class,'subvote']);
    Route::post('/addLikeajx/{id}',[App\Http\Controllers\EmitenVoteController::class,'addlikeajx']);
    Route::post('/addVoteajx/{id}',[App\Http\Controllers\EmitenVoteController::class,'addvoteajx']);
    Route::post('/subLikeajx/{id}',[App\Http\Controllers\EmitenVoteController::class,'sublikeajx']);
    Route::post('/subVoteajx/{id}',[App\Http\Controllers\EmitenVoteController::class,'subvoteajx']);
    Route::post('/sendData/{id}',[App\Http\Controllers\EmitenCommentController::class,'sendComment']);
});

Route::get('/getmodaldata/{id}',[App\Http\Controllers\EmitenCommentController::class,'getcomment']);
Route::get('/getlike/{id}',[App\Http\Controllers\EmitenVoteController::class,'clike']);
Route::get('/getvote/{id}',[App\Http\Controllers\EmitenVoteController::class,'cvote']);
// Route::post('/cropImg', [App\Http\Controllers\EmitenController::class, 'logoCropImg'])->name('cropImg');
Route::post('/logocropImg', [App\Http\Controllers\EmitenController::class, 'logocropImg'])->name('logocropImg');
Route::post('/profilecropImg', [App\Http\Controllers\EmitenController::class, 'profilecropImg'])->name('profilecropImg');
Route::post('/covercropImg', [App\Http\Controllers\EmitenController::class, 'covercropImg'])->name('covercropImg');
Route::post('/galericropImg', [App\Http\Controllers\EmitenController::class, 'galericropImg'])->name('galericropImg');
Route::post('/galericropImg2', [App\Http\Controllers\EmitenController::class, 'galericropImg'])->name('galericropImg2');
Route::post('/galericropImg3', [App\Http\Controllers\EmitenController::class, 'galericropImg'])->name('galericropImg3');
Route::post('/ownercropImg', [App\Http\Controllers\EmitenController::class, 'ownercropImg'])->name('ownercropImg');
// Route::post('/cropImg', 'CropImage@cropImg')->name('cropImg');

Route::get('/scheduler/broadcast-notif', [App\Http\Controllers\PushNotificationController::class, 'schedulerbroadcastNotif']);
