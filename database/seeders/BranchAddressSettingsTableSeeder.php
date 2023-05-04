<?php

namespace Database\Seeders;

use App\Models\BranchAddressSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchAddressSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BranchAddressSetting::insert([
            ['key' => 'country', 'value' => 'EG', 'branch_id' => 1],
            ['key' => 'governate', 'value' => 'cairo', 'branch_id' => 1],
            ['key' => 'regionCity', 'value' => 'city center', 'branch_id' => 1],
            ['key' => 'street', 'value' => 'CFC', 'branch_id' => 1],
            ['key' => 'buildingNumber', 'value' => '18', 'branch_id' => 1],
            ['key' => 'country', 'value' => 'EG', 'branch_id' => 2],
            ['key' => 'governate', 'value' => 'giza', 'branch_id' => 2],
            ['key' => 'regionCity', 'value' => 'october city', 'branch_id' => 2],
            ['key' => 'street', 'value' => 'Ahly Sporting Club', 'branch_id' => 2],
            ['key' => 'buildingNumber', 'value' => '1', 'branch_id' => 2],
        ]);
    }
}