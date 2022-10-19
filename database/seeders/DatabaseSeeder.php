<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(ClassRoomSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserSeeder::class);
    }
}
