<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Services\SendInvoiceService;

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

Route::get('test-send', function () {
    $branches = Branch::with([
        'address',
        'credentials' => fn ($query) => $query->where('is_prod', false)
    ])->get();
    foreach ($branches as $branch) {
        SendInvoiceService::handle($branch, $branch->credentials->first(), now()->subDay()->format('Y-m-d'));
    }
});
Route::get('/insert-data', function () {
    DB::table('branches')->insert([
        [
            'id' => 1,
            'name' => 'cairo festival',
            'branch_code' => '0',
            'activity_code' => '5610'
        ],
        [
            'id' => 2,
            'name' => 'zayed',
            'branch_code' => '1',
            'activity_code' => '5610'
        ]
    ]);
    DB::table('branch_address_settings')->insert([
        [
            'id' => 1,
            'key' => 'country',
            'value' => 'EG',
            'branch_id' => 1
        ],
        [
            'id' => 2,
            'key' => 'governate',
            'value' => 'cairo',
            'branch_id' => 1
        ],
        [
            'id' => 3,
            'key' => 'regionCity',
            'value' => 'city center',
            'branch_id' => 1
        ],
        [
            'id' => 4,
            'key' => 'street',
            'value' => 'CFC',
            'branch_id' => 1
        ],
        [
            'id' => 5,
            'key' => 'buildingNumber',
            'value' => '18qw',
            'branch_id' => 1,
            'updated_at' => '2023-05-03 17:54:26'
        ],
        [
            'id' => 6,
            'key' => 'country',
            'value' => 'EG',
            'branch_id' => 2
        ],
        [
            'id' => 7,
            'key' => 'governate',
            'value' => 'giza',
            'branch_id' => 2
        ],
        [
            'id' => 8,
            'key' => 'regionCity',
            'value' => 'october city',
            'branch_id' => 2
        ],
        [
            'id' => 9,
            'key' => 'street',
            'value' => 'Ahly Sporting Club',
            'branch_id' => 2
        ],
        [
            'id' => 10,
            'key' => 'buildingNumber',
            'value' => '1',
            'branch_id' => 2
        ]
    ]);

    DB::table('branch_credentials')->insert([
        [
            'id' => 1,
            'branch_id' => '1',
            'device_serial_number' => 'POS-TEST-001',
            'client_id' => 'b847ac72-1309-4e99-8357-7bc70f1cb174',
            'client_secret' => '016c4c18-ad08-4515-970f-81eac7e90bc8',
            'pos_os_version' => 'os',
            'is_prod' => 0
        ],
        [
            'id' => 2,
            'branch_id' => '2',
            'device_serial_number' => 'POS-TEST-ZAYED',
            'client_id' => 'f01ec51a-21f5-4b7b-aeed-e35c6a415ffc',
            'client_secret' => '18305091-939f-4b56-a53b-53a7f4c60ca4',
            'pos_os_version' => 'os',
            'is_prod' => 0
        ],
        [
            'id' => 3,
            'branch_id' => '1',
            'device_serial_number' => 'SBARRO-CFC-001',
            'client_id' => '7d34dce7-2ac1-425c-8f04-f4ed52696b8a',
            'client_secret' => '3156b548-ac73-4c17-96a5-ea31827a3183',
            'pos_os_version' => 'Windows',
            'is_prod' => 1
        ],
        [
            'id' => 4,
            'branch_id' => '2',
            'device_serial_number' => 'SBARRO-Zayed-001',
            'client_id' => 'e1ab2375-1131-4b39-b95b-573b1ddd76e5',
            'client_secret' => 'c0408788-4816-47dc-aa00-dfc0a39e5bef',
            'pos_os_version' => 'Windows',
            'is_prod' => 1
        ]
    ]);
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
