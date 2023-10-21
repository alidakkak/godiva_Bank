<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/loginForAdmin', [\App\Http\Controllers\AuthController::class, 'loginForAdmin']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);


//Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/user-profile', [\App\Http\Controllers\AuthController::class, 'userProfile']);


    Route::get('/customers', [\App\Http\Controllers\CustomerController::class, 'index']);
    Route::post('/customers', [\App\Http\Controllers\CustomerController::class, 'store']);
    Route::post('/customers/{customer}', [\App\Http\Controllers\CustomerController::class, 'update']);
    Route::get('/customers/{customer}', [\App\Http\Controllers\CustomerController::class, 'show']);

//});
