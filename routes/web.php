<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Front_end\HomeController;
use App\Http\Controllers\Front_end\Now_playingController;
use App\Http\Controllers\Front_end\Coming_soonController;
use App\Http\Controllers\Front_end\Sold_outController;
use App\Http\Controllers\Front_end\Daftar_bisnisController;
use App\Http\Controllers\Front_end\Mulai_investasiController;

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
Route::group(['middleware' => ['auth','pin', 'checkRole:2', "verified"]], function () {
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'indexuser']);
    Route::get('/user/emiten', [App\Http\Controllers\EmitenController::class, 'index_user']);
    Route::get('/user/bisnis_anda', [App\Http\Controllers\EmitenController::class, 'user_emiten']);
    Route::get('/user/pesan_saham', [App\Http\Controllers\BookSahamController::class, 'index_user']);
    Route::get('/user/pesan_saham/detail/{id}', [App\Http\Controllers\BookSahamController::class, 'detail_user']);

    Route::post('/upload_bukti/{id}', [App\Http\Controllers\BookSahamController::class, 'upload_bukti']);
    Route::get('/edit_bisnis/{id}', [App\Http\Controllers\EmitenController::class, 'edit_bisnis']);
    Route::post('/update_bisnis/{id}',[App\Http\Controllers\EmitenController::class, 'update_bisnis']);

    Route::get('/edit_profile/{id}',[App\Http\Controllers\TraderController::class, 'edit_profile']);
    Route::post('/update_profile/{id}',[App\Http\Controllers\TraderController::class, 'update_profile']);
    
    Route::get('/user/portfolio',[App\Http\Controllers\TraderController::class, 'portofolio']);
    Route::get('/user/riwayat_aktifitas',[App\Http\Controllers\TraderController::class, 'history']);
    Route::get('/user/video_tutorial',[App\Http\Controllers\TraderController::class, 'video']);
    Route::get('/results', [App\Http\Controllers\TraderController::class, 'results'])->name('results');
    Route::get('/watch/{id}', [App\Http\Controllers\TraderController::class, 'watch'])->name('watch');
    
    Route::post('/user/read',[App\Http\Controllers\TraderController::class, 'read_message']);
    Route::get('/user/transaksi', [App\Http\Controllers\TransactionsController::class, 'user_transaksi']);
    Route::get('/user/deposit', [App\Http\Controllers\DepositController::class, 'user_depo']);
    Route::post('/user/create_deposit', [App\Http\Controllers\DepositController::class, 'user_cdepo']);
    Route::get('/user/penarikan', [App\Http\Controllers\PenarikanController::class, 'user_tarik']);
    
    
});

Route::get('pin',[App\Http\Controllers\TraderController::class, 'pinv'])->name('pinv');
Route::post('pin_post',[App\Http\Controllers\TraderController::class, 'pin']);

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
    Route::post('/admin/crm/save-konten', [App\Http\Controllers\CRMController::class, 'saveKonten']);
    Route::post('/admin/crm/save-publish', [App\Http\Controllers\CRMController::class, 'savePublish']);
    Route::get('/admin/crm/get-category', [App\Http\Controllers\CRMController::class, 'getCategories']);
    
    Route::get('/admin/get-provinsi', [App\Http\Controllers\AddressController::class, 'getProvince']);
    Route::get('/admin/get-regency', [App\Http\Controllers\AddressController::class, 'getRegency']);

    Route::get('/admin/push-notif/{id}', [App\Http\Controllers\PushNotificationController::class, 'pushNotif']);
    
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

Route::get('/detail-now-playing/{id}', [Now_playingController::class, 'detail'])->name('now-playing.detail');
Route::get('/detail-coming-soon/{id}', [Coming_soonController::class, 'detail'])->name('coming-soon.detail');
Route::get('/detail-sold-out', [Sold_outController::class, 'detail'])->name('sold-out.detail');

Route::group(['middleware' => ['auth', "verified"]], function () {
    Route::get('/daftar-bisnis/create', [Daftar_bisnisController::class, 'create'])->name('daftar-bisnis.create');
    Route::post('/daftar-bisnis/store',[Daftar_bisnisController::class, 'store'])->name('daftar-bisnis.store');
    Route::post('/addLike/{id}',[App\Http\Controllers\EmitenVoteController::class,'addlike']);
    Route::post('/addVote/{id}',[App\Http\Controllers\EmitenVoteController::class,'addvote']);
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
Route::post('/ownercropImg', [App\Http\Controllers\EmitenController::class, 'ownercropImg'])->name('ownercropImg');
// Route::post('/cropImg', 'CropImage@cropImg')->name('cropImg');
