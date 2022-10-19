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
            'facebook'           => 'asdaf',
            'youtube'            => 'lasfa',
            'twitter'            => 'asdfa',
            'linkedin'           => 'safa',
            'side_bg_color'      => 'sdafda',
            'side_text_color'    => 'asdafasf',
            'nav_bg_color'       => 'asdfaf',
            'nav_text_color'     =>'asdaf',
            'timezone'           => 'asdfa',
            'currency_symbol'    => 'asdfaf',
            'app_url'            => 'afdasf',
            'db_host'            => 'sdafa',
            'db_port'            => 'asdfasf',
            'db_name'            => 'sdafa',
            'db_username'        => 'asdfaf',
            'db_password'        =>  'asdf',
        ]);
    }
}
