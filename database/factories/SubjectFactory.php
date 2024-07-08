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
        /*
        $subjects = ['Math', 'Biology', 'Literature', 'Chemistry', 'Geography'];

        return [
            'title' => $this->faker->unique()->randomElement($subjects),
        ];
        */
        return [];
    }
}
