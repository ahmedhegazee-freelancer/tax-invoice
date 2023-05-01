<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Permission::insert([
            [
                'name' => 'manage-admins',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-banners',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-customers',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-customers-messages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-bookings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-races',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-events',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-tickets',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-transactions',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-pages',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-settings',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-coupons',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-countries',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-nationalities',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-results',
                'guard_name' => 'web',
            ],
            [
                'name' => 'manage-age-groups',
                'guard_name' => 'web',
            ],
        ]);
        // $this->call("OthersTableSeeder");
    }
}