<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(["verified"]);
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
});