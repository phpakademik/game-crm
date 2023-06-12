<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\BronController;
use App\Http\Controllers\DebtersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware'=>'auth'],function (){
    Route::resource('/services',ServiceController::class);
    Route::resource('/brons',BronController::class);
    Route::resource('/debters',DebtersController::class);
    Route::get('/test',[\App\Http\Controllers\TestController::class,'index']);
});
