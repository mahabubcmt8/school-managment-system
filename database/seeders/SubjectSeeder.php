<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;


class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'class_id' => 1,
            'name' => 'Bangla',
            'code' => 101,
            'type' => "Theory",
            'optional' => 1,
            'total_mark' => 100,
            'pass_mark' => 40,
        ]);

    }
}
