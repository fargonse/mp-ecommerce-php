<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('detail', [\App\Http\Controllers\DetailController::class, 'getDetail']);

Route::post('checkout', [\App\Http\Controllers\CheckoutController::class, 'sendCheckout']);
