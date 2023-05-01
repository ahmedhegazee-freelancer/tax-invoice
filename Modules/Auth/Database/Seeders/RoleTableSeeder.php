<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Entities\Team;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Role::insert([
            ['name' => 'super-admin', 'guard_name' => 'web',],
            ['name' => 'customer', 'guard_name' => 'web',],
            ['name' => 'admin', 'guard_name' => 'web',],
        ]);
        $permissions = Permission::all()->pluck('name')->toArray();
        Role::first()->syncPermissions($permissions);
        // $this->call("OthersTableSeeder");
    }
}