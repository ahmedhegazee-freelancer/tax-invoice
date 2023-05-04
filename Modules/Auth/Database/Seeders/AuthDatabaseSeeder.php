<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Entities\User;
use Modules\Tenant\Database\Seeders\TenantDatabaseSeeder;
use Illuminate\Support\Str;
use Modules\Auth\Entities\Team;

class AuthDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // Team::all()->each(function ($team) {
        $superAdmin = User::create([
            'email' => 'admin@email.com',
            'name' => 'Admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $superAdmin->assignRole(['super-admin', 'admin']);
        // });

        // $this->call("OthersTableSeeder");
    }
}