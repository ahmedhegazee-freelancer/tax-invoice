<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Settings\Entities\Setting;

class SettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Setting::insert([
            ['key' => 'phone', 'value' => '+97444111111'],
            ['key' => 'whatsapp', 'value' => '+97444111111'],
            ['key' => 'facebook', 'value' => 'https://www.facebook.com'],
            ['key' => 'instagram', 'value' => 'https://www.instagram.com'],
            ['key' => 'twitter', 'value' => 'https://www.twitter.com'],
            ['key' => 'snapchat', 'value' => 'https://www.snapchat.com'],
            ['key' => 'youtube', 'value' => 'https://www.youtube.com'],
            // ['key' => 'version', 'value' => '1.0.0'],
        ]);
        // $this->call("OthersTableSeeder");
    }
}