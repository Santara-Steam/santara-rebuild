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
Route::group(['middleware' => ['auth', 'checkRole:2', "verified"]], function () {
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
    
});
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
    
    Route::get('/admin/pesan_saham', [App\Http\Controllers\BookSahamController::class, 'index']);
    Route::get('/admin/pesan_saham/add', [App\Http\Controllers\BookSahamController::class, 'create']);
    Route::post('/pesan_saham/store',[App\Http\Controllers\BookSahamController::class, 'store']);
    Route::get('/admin/pesan_saham/detail/{id}', [App\Http\Controllers\BookSahamController::class, 'detail']);
    Route::post('/admin/pesan_saham/approve/{id}', [App\Http\Controllers\BookSahamController::class, 'approve']);
    Route::post('/admin/pesan_saham/reject/{id}', [App\Http\Controllers\BookSahamController::class, 'reject']);
    
    Route::get('/admin/transactions', [App\Http\Controllers\TransactionsController::class, 'index']);
    Route::get('/admin/get_transactions', [App\Http\Controllers\TransactionsController::class, 'fetchData']);
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
