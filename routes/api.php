<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::group(['middleware' => ['guest'], 'prefix' => 'v1'], function () {
    Route::post('login', [LoginController::class, 'login'])->name("login");
    // Route::post('register', RegisterController::class)->name("register");
    // Route::post('forgot', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name("forgot");
    // Route::post('reset', [ResetPasswordController::class, 'reset'])->name("reset");
});


Route::group(['middleware' => ['auth:api'], 'prefix' => 'v1'], function () {

    Route::get('refresh', [LoginController::class, 'refresh'])->name("refresh");

    Route::get("test", function () {
        return response()->json(['status' => 'ok', 'data' => request()->all()]);
    });


    Route::apiResources([]);
});