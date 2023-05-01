<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\CustomerMessage\Http\Controllers\Admin\CustomerMessageController;

Route::middleware(['auth', 'role:admin', 'permission:manage-customers-messages'])
    ->prefix('dashboard')
    ->name('dashboard.')->group(function () {
        Route::resource('customer-message', CustomerMessageController::class)
            ->parameter('customer-message', 'message')
            ->only(['index', 'destroy']);
    });