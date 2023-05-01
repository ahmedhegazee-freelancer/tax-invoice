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
use Modules\Transaction\Http\Controllers\TransactionController;

Route::middleware(['web', 'auth:sanctum', 'role:admin', 'permission:manage-transactions'])
    ->prefix('dashboard')
    ->name('dashboard.')->group(function () {
        Route::get('transaction', TransactionController::class)->name('transaction.index');
    });