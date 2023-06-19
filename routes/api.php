<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\BronController;
use App\Http\Controllers\DebtersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkdateController;

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

Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware'=>'auth'],function (){
//    Route::resource('/services',ServiceController::class);
    Route::group(['prefix'=>'/services'],function (){
       Route::get('/',[ServiceController::class,'index']);
       Route::post('/',[ServiceController::class,'store']);
       Route::get('/{id}',[ServiceController::class,'show']);
       Route::put('/{id}',[ServiceController::class,'update']);
       Route::delete('/{id}',[ServiceController::class,'destroy']);
       Route::get('/set-status/{id}',[ServiceController::class,'setStatus']);
    });
    Route::resource('/brons',BronController::class);
    Route::resource('/debters',DebtersController::class);
    Route::post('/work/start',[WorkdateController::class,'start']);
    Route::post('/work/end',[WorkdateController::class,'end']);
    Route::group(['prefix'=>'/profile'],function (){
       Route::get('/{id}',[ProfileController::class,'show']);
       Route::post('/create',[ProfileController::class,'store']);
       Route::post('/update/{id}',[ProfileController::class,'update']);
    });
});
