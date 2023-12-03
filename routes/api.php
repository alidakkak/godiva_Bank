<?php

use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/check_voucher/{id}', [\App\Http\Controllers\Cashier\VoucherController::class, 'check_voucher']);
Route::group([ 'middleware' => 'check_user:Cashier,Admin,Super'], function () {
    Route::get('/download/{folder}/{name}', [VoucherController::class, "download"]);
    Route::get('/get_all_customers', [CustomerController::class, 'index']);

});
