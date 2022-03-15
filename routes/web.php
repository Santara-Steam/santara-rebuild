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
});
Route::group(['middleware' => ['auth', 'checkRole:1', "verified"]], function () {
    Route::get('/admin', [App\Http\Controllers\HomeController::class, 'indexadmin']);
    Route::get('/admin/emiten', [App\Http\Controllers\EmitenController::class, 'index']);
    Route::get('/admin/emiten/add', [App\Http\Controllers\EmitenController::class, 'add']);
    Route::post('/emiten/store',[App\Http\Controllers\EmitenController::class, 'store']);
    Route::get('/admin/emiten/edit/{id}', [App\Http\Controllers\EmitenController::class, 'edit']);
    Route::post('/emiten/update/{id}',[App\Http\Controllers\EmitenController::class, 'update']);
    Route::post('/emiten/delete/{id}',[App\Http\Controllers\EmitenController::class, 'delete']);
    Route::post('/emiten/update_status/{id}',[App\Http\Controllers\EmitenController::class, 'emiten_status']);
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);

Route::get('/', [HomeController::class, 'index']);

Route::resource('/now-playing', Now_playingController::class);
Route::resource('/coming-soon', Coming_soonController::class);
Route::resource('/sold-out', Sold_outController::class);
Route::resource('/daftar-bisnis', Daftar_bisnisController::class);
Route::resource('/mulai-investasi', Mulai_investasiController::class);

Route::get('/detail-now-playing', [Now_playingController::class, 'detail'])->name('now-playing.detail');;
Route::get('/detail-coming-soon', [Coming_soonController::class, 'detail'])->name('coming-soon.detail');;
Route::get('/detail-sold-out', [Sold_outController::class, 'detail'])->name('sold-out.detail');;

Route::get('/daftarkan-bisnis', [Daftar_bisnisController::class, 'add'])->name('daftar-bisnis.add');;