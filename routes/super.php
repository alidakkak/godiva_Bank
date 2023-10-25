<?php

use App\Http\Controllers\Super\SuperController;
use Illuminate\Support\Facades\Route;

Route::group([ 'middleware' => 'check_user:Super'], function () {
    Route::apiResource('user', SuperController::class);
});
