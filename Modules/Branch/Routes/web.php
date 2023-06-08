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
use Modules\Branch\Http\Controllers\Admin\BranchAddressSettingsController;
use Modules\Branch\Http\Controllers\Admin\BranchController;
use Modules\Branch\Http\Controllers\Admin\BranchCredentialController;
use Modules\Branch\Http\Controllers\Admin\BusinessSettingsController;
use Modules\Branch\Http\Controllers\Admin\InvoiceController;

Route::resource('branch', BranchController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('branch/{branch}/credential', BranchCredentialController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('branch/{branch}/address', BranchAddressSettingsController::class)->only(['index', 'edit', 'update']);
Route::resource('business-setting', BusinessSettingsController::class)
    ->only(['index', 'edit', 'update'])
    ->parameter('business-setting', 'setting');
Route::get('branch/{branch}/invoices', [InvoiceController::class, 'index'])->name('branch.invoices.index');
Route::get('upload-invoices', [InvoiceController::class, 'showUpload'])->name('invoices.upload');
Route::post('upload-invoices', [InvoiceController::class, 'upload'])->name('invoices.upload.store');
Route::get('send-invoices', [InvoiceController::class, 'showSend'])->name('invoices.send');
Route::post('send-invoices', [InvoiceController::class, 'send'])->name('invoices.send.store');
Route::post('send-unsent-invoices', [InvoiceController::class, 'sendInvoices'])->name('invoices.send.unsent-invoices');
Route::get('show-unsent', [InvoiceController::class, 'showUnsentInvoices'])->name('invoices.unsent');
Route::get('export-json', [InvoiceController::class, 'exportJson'])->name('invoices.export-json');