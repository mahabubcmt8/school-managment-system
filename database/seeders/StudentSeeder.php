<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'class_id' => 1,
            'section_id' => 1,
            'id_no' => 100100,
            'roll_no' => 01,
            'dob' => 10-10-2022,
            'gender' => 'male',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];

        Student::factory()->count(30)->create();
    }
}
