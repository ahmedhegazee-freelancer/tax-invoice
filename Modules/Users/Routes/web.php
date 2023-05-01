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
use Modules\Auth\Entities\User;
use Modules\Users\Http\Controllers\Admin\ChildrenController;
use Modules\Users\Http\Controllers\Admin\RolesController;
use Modules\Users\Http\Controllers\Admin\CustomerController;
use Modules\Users\Http\Controllers\Admin\UsersController;

Route::middleware(['permission:manage-admins'])->group(function () {
    Route::resource('user', UsersController::class)->except('show');
    Route::resource('role', RolesController::class)->except('show');
});
Route::middleware(['permission:manage-customers'])->group(function () {
    Route::resource('customer', CustomerController::class)
        ->parameter('customer', 'user')
        ->except(['show', 'create', 'store']);
    Route::post('send-notification', [CustomerController::class, 'sendNotification'])->name('send-notification');
});
Route::post('user/{user}/toggle-block', function (User $user) {
    $user->is_blocked = !$user->is_blocked;
    $user->save();
    return redirect()->back();
})->name('toggle-block');