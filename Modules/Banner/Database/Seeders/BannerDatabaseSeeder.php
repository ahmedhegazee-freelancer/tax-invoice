<?php

namespace Modules\Banner\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Banner\Entities\Banner;

class BannerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Banner::insert([
            ['url' => 'default/banner.png', 'locale' => 'ar'],
            ['url' => 'default/banner.png', 'locale' => 'ar'],
            ['url' => 'default/banner.png', 'locale' => 'ar'],
            ['url' => 'default/banner.png', 'locale' => 'en'],
            ['url' => 'default/banner.png', 'locale' => 'en'],
            ['url' => 'default/banner.png', 'locale' => 'en'],
        ]);
        // $this->call("OthersTableSeeder");
    }
}