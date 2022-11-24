<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = Settings::create([
            'system_name'        => 'abc school',
            'system_title'       => 'abc school',
            'email'              => 'abc@domain.com',
            'phone'              => '55641645',
            'address'            => 'khulna',
            'system_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
            'favicon'            => null,
            'logo'               => null,
            'facebook'           => 'https://www.facebook.com/',
            'youtube'            => 'https://www.youtube.com/',
            'twitter'            => 'https://twitter.com/',
            'linkedin'           => 'https://www.linkedin.com/',
            'side_bg_color'      => '#000',
            'side_text_color'    => '#fff',
            'nav_bg_color'       => '#000',
            'nav_text_color'     => '#fff',
            'timezone'           => 'BD',
            'currency_symbol'    => '$',
            'app_url'            => 'website link',
            'db_host'            => '',
            'db_port'            => '',
            'db_name'            => '',
            'db_username'        => '',
            'db_password'        => '',
        ]);
    }
}
