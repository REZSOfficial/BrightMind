<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $subjects = ['Math', 'Biology', 'Literature', 'Chemistry', 'Geography'];

        foreach ($subjects as $subject) {
            Subject::firstOrCreate(['title' => $subject]);
        }

        Course::factory(15)->create();
    }
}
