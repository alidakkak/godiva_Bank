<?php

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

        Route::post('auth/login/{role}', [AuthController::class, 'login']);
    Route::group([ 'middleware' => 'check_user:Cashier,Admin,Super'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
    });
