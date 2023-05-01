<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\AuthController;
use Modules\Auth\Http\Controllers\Api\ChangeUserDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('send-otp', 'sendOTP');
    Route::post('forget-password', 'forgetPassword');
    Route::post('reset-password', 'resetPassword');
    Route::middleware(['locale', 'auth:sanctum'])->group(function () {
        Route::get('user-data', 'UserData');
        Route::post('logout', 'logout');
        Route::delete('user-delete', 'destroy');
    });
});
Route::controller(ChangeUserDataController::class)
    ->middleware('auth:sanctum')
    ->prefix('auth')
    ->group(function () {
        Route::put('profile', 'updateProfile');
        Route::post('profile-image', 'updateProfileImage');
        Route::put('password', 'updatePassword');
        Route::put('email', 'updateEmail');
    });
