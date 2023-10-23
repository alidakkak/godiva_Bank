<?php

use App\Http\Controllers\Admin\CustomerController;

use App\Http\Controllers\Cashier\VoucherController;
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

    Route::group([ 'middleware' => 'check_user:Cashier'], function () {
    // voucher
        Route::post('/store_new_voucher', [VoucherController::class, "store"]);
        Route::post('/store_existing_voucher', [VoucherController::class, "existing"]);
    });
