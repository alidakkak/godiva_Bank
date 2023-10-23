<?php
//
//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\CustomerController;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//
///*
//|--------------------------------------------------------------------------
//| API Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register API routes for your application. These
//| routes are loaded by the RouteServiceProvider and all of them will
//| be assigned to the "api" middleware group. Make something great!
//|
//*/
//
//        Route::post('auth/login', [AuthController::class, 'loginForCashier']);
//        Route::post('auth/loginForAdmin', [AuthController::class, 'loginForAdmin']);
//    Route::group([ 'middleware' => 'check_user:Cashier,Admin'], function () {
//        Route::post('/logout', [AuthController::class, 'logout']);
//    });
//    // Admin
//    Route::group([ 'middleware' => 'check_user:Admin'], function () {
//        Route::get('/GetAllCustomers', [CustomerController::class, 'index']);
//
////    Route::get('/customers', [CustomerController::class, 'index']);
////    Route::post('/customers', [CustomerController::class, 'store']);
////    Route::post('/customers/{customer}', [CustomerController::class, 'update']);
////    Route::get('/customers/{customer}', [CustomerController::class, 'show']);
//
//    });
