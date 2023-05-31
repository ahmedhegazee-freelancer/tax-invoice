<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/insert-data', function () {
    DB::statement("DROP TABLE IF EXISTS `branch_address_settings`;
CREATE TABLE `branch_address_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branch_settings_unique` (`key`,`branch_id`),
  KEY `branch_address_settings_branch_id_foreign` (`branch_id`),
  CONSTRAINT `branch_address_settings_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `branch_credentials`;
CREATE TABLE `branch_credentials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos_os_version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prod` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `business_settings`;
CREATE TABLE `business_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `branch_address_settings` (`id`, `key`, `value`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'country', 'EG', 1, NULL, NULL),
(2, 'governate', 'cairo', 1, NULL, NULL),
(3, 'regionCity', 'city center', 1, NULL, NULL),
(4, 'street', 'CFC', 1, NULL, NULL),
(5, 'buildingNumber', '18qw', 1, NULL, '2023-05-03 17:54:26'),
(6, 'country', 'EG', 2, NULL, NULL),
(7, 'governate', 'giza', 2, NULL, NULL),
(8, 'regionCity', 'october city', 2, NULL, NULL),
(9, 'street', 'Ahly Sporting Club', 2, NULL, NULL),
(10, 'buildingNumber', '1', 2, NULL, NULL);

INSERT INTO `branch_credentials` (`id`, `branch_id`, `device_serial_number`, `client_id`, `client_secret`, `pos_os_version`, `is_prod`, `created_at`, `updated_at`) VALUES
(1, '1', 'POS-TEST-001', 'b847ac72-1309-4e99-8357-7bc70f1cb174', '016c4c18-ad08-4515-970f-81eac7e90bc8', 'os', 0, NULL, NULL),
(2, '2', 'POS-TEST-ZAYED', 'f01ec51a-21f5-4b7b-aeed-e35c6a415ffc', '18305091-939f-4b56-a53b-53a7f4c60ca4', 'os', 0, NULL, NULL),
(3, '1', 'SBARRO-CFC-001', '7d34dce7-2ac1-425c-8f04-f4ed52696b8a', '3156b548-ac73-4c17-96a5-ea31827a3183', 'Windows', 1, NULL, NULL),
(4, '2', 'SBARRO-Zayed-001', 'e1ab2375-1131-4b39-b95b-573b1ddd76e5', 'c0408788-4816-47dc-aa00-dfc0a39e5bef', 'Windows', 1, NULL, NULL);

INSERT INTO `branches` (`id`, `name`, `branch_code`, `activity_code`, `created_at`, `updated_at`) VALUES
(1, 'cairo festival', '0', '5610', NULL, NULL),
(2, 'zayed', '1', '5610', NULL, NULL),
(3, 'sdasd', '12312', '1', NULL, NULL);

INSERT INTO `business_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'receiptType', 's', NULL, NULL),
(2, 'typeVersion', '1.2', NULL, '2023-05-03 19:07:06'),
(3, 'Order Delivery Mode', 'FC', NULL, NULL),
(4, 'rin', '533544378', NULL, NULL),
(5, 'companyTradeName', 'Sbarro Egypt', NULL, NULL),
(6, 'paymentMethod', 'C', NULL, NULL);
");
});

Route::get('/', function () {
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
