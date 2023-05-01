<?php

namespace Modules\Page\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Page\Entities\Page;
use Modules\Page\Entities\PageTranslation;

class PageDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Page::insert([
            ['slug' => 'privacy-policy',],
            ['slug' => 'terms-conditions',],
            ['slug' => 'mindset',],
        ]);
        PageTranslation::insert([
            ['page_id' => 1, 'locale' => 'ar', 'title' => 'سياسة الخصوصية', 'content' => '<p>سياسة الخصوصية</p>'],
            ['page_id' => 1, 'locale' => 'en', 'title' => 'Privacy Policy', 'content' => '<p>Privacy Policy</p>'],
            ['page_id' => 2, 'locale' => 'ar', 'title' => 'الشروط والاحكام', 'content' => '<p>الشروط والاحكام</p>'],
            ['page_id' => 2, 'locale' => 'en', 'title' => 'Terms and Conditions', 'content' => '<p>Terms and conditions</p>'],
            ['page_id' => 3, 'locale' => 'ar', 'title' => 'عن التطبيق', 'content' => '<p>عن التطبيق</p>'],
            ['page_id' => 3, 'locale' => 'en', 'title' => 'Mindset', 'content' => '<p>About us</p>'],
        ]);
        // $this->call("OthersTableSeeder");
    }
}