<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/pay-details',[\App\Http\Controllers\PayController::class,'show']);
Route::post('/store/pay-details',[\App\Http\Controllers\PayController::class,'store'])->name('store.pay');


Route::post('/pay',[\App\Http\Controllers\PayController::class,'pay'])->name('payment.pay');
Route::get('/state',[\App\Http\Controllers\PayController::class,'state'])->name('payment.state');
