<?php

namespace Modules\Branch\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Branch\Entities\Branch;
use Modules\Branch\Entities\BranchCredential;

class BranchDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Branch::insert([
            [
                'name' => 'cairo festival',
                'branch_code' => 0,
                'activity_code' => '5610',
            ],
            [
                'name' => 'zayed',
                'branch_code' => 1,
                'activity_code' => '5610',
            ],
        ]);
        BranchCredential::insert([
            [
                'branch_id' => 1,
                'device_serial_number' => 'POS-TEST-001',
                'client_id' => 'b847ac72-1309-4e99-8357-7bc70f1cb174',
                'client_secret' => '016c4c18-ad08-4515-970f-81eac7e90bc8',
                'pos_os_version' => 'os',
                'is_prod' => false
            ],
            [
                'branch_id' => 2,
                'device_serial_number' => 'POS-TEST-ZAYED',
                'client_id' => 'f01ec51a-21f5-4b7b-aeed-e35c6a415ffc',
                'client_secret' => '18305091-939f-4b56-a53b-53a7f4c60ca4',
                'pos_os_version' => 'os',
                'is_prod' => false
            ], [
                'branch_id' => 1,
                'device_serial_number' => 'SBARRO-CFC-001',
                'client_id' => '7d34dce7-2ac1-425c-8f04-f4ed52696b8a',
                'client_secret' => '3156b548-ac73-4c17-96a5-ea31827a3183',
                'pos_os_version' => 'Windows',
                'is_prod' => true
            ],
            [
                'branch_id' => 2,
                'device_serial_number' => 'SBARRO-Zayed-001',
                'client_id' => 'e1ab2375-1131-4b39-b95b-573b1ddd76e5',
                'client_secret' => 'c0408788-4816-47dc-aa00-dfc0a39e5bef',
                'pos_os_version' => 'Windows',
                'is_prod' => true
            ]
        ]);
        // $this->call("OthersTableSeeder");
    }
}