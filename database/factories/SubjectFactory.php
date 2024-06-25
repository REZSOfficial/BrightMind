<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subjects = ['Math', 'Biology', 'Literature', 'Chemistry', 'Geography'];
        $subject = $subjects[array_rand($subjects)];
        $img = $subject . ".png";
        return [
            'user_id' => User::factory(),
            'title' => $subject,
            'grade' => array_rand([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]),
            'description' => fake()->sentence(),
            'cover_image' => $img,
        ];
    }
}
