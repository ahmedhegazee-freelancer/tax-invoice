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
            'email' => 'super-admin@email.com',
            'first_name' => 'Super',
            'middle_name' => 'Admin',
            'last_name' => 'Admin',
            'phone' => '+97444111111',
            'country_code' => '+974',
            'country_id' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'date_of_birth' => '1998-10-20',
            'age' => 24,
            'age_group_id' => 3,
            'gender_id' => 1,
            'nationality_id' => 1,
            'uuid' => Str::uuid(),

        ]);

        $superAdmin->assignRole(['super-admin', 'admin']);
        $customer = User::create([
            'email' => 'customer@email.com',
            'first_name' => 'Salem',
            'middle_name' => 'Ali',
            'last_name' => 'Sami',
            'phone' => '+97444995326',
            'country_code' => '+974',
            'country_id' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'uuid' => Str::uuid(),
            'date_of_birth' => '1998-10-20',
            'age' => 24,
            'age_group_id' => 3,
            'gender_id' => 1,
            'nationality_id' => 1,
        ]);
        $customer->assignRole('customer');
        $admin = User::create([
            'email' => 'customer2@email.com',
            'first_name' => 'Salwa',
            'middle_name' => 'Khaled',
            'last_name' => 'Mohammed',
            'phone' => '+97444995325',
            'country_code' => '+974',
            'country_id' => 1,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'uuid' => Str::uuid(),
            'date_of_birth' => '1998-10-20',
            'age' => 24,
            'age_group_id' => 3,
            'gender_id' => 2,
            'nationality_id' => 1,
        ]);
        $admin->assignRole('customer');
        // });

        // $this->call("OthersTableSeeder");
    }
}