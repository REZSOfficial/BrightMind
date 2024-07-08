<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subject = Subject::inRandomOrder()->first();
        return [
            'user_id' => User::factory(),
            'subject_id' => $subject->id,
            'title' => $this->faker->title(),
            'cover_image' => $subject->title . '.png',
            'grade' => $this->faker->numberBetween(1, 12),
            'updated_at' => now(),
            'created_at' => now()
        ];
    }
}
