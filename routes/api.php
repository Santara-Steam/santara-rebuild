<?php

use App\Helpers\EmitenHelper;
use App\Helpers\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/emiten/store',[App\Http\Controllers\EmitenController::class, 'store']);

Route::get('/ownPortofolio', function () {
   return Portofolio::getApiPortofolio();
});

Route::get('/admin-emiten', function (){
   return response()->json([
       "emitenIds" => EmitenHelper::AdminEmitens()
   ]);
});

Route::get('/trader-emiten', function (){
    return response()->json([
        "emitenIds" => EmitenHelper::TraderEmitens()
    ]);
});
