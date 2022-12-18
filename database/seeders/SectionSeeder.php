<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Section::create([
        //     'name' => "A",
        //     'capacity' => 30,
        //     'class_id' => 1,
        // ]);
         Section::factory()->count(10000)->create();
    }
}
