<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lessons')->insert([
            ['title' => 'English A1', 'description' => 'Basic English level.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'English A2', 'description' => 'Elementary English level.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'English B1', 'description' => 'Intermediate English level.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'English B2', 'description' => 'Upper Intermediate English level.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'English C1', 'description' => 'Advanced English level.', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'English C2', 'description' => 'Proficiency English level.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
