<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VoucherController;
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

    Route::group([ 'middleware' => 'check_user:Admin'], function () {
    // customer
        Route::get('/get_all_customers', [CustomerController::class, 'index']);
        Route::get('/get_five_last_customers_with_percentage', [CustomerController::class, "get_five_last_customers_with_percentage"]);
    // voucher
        Route::get('/get_voucher', [VoucherController::class, "index"]);
        Route::get('/exportToExcel', [VoucherController::class, "exportToExcel"]);
        Route::get('/exportToPdf', [VoucherController::class, "exportToPdf"]);
    });
