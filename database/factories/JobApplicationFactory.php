<?php

namespace Database\Factories;

use App\Models\JobPosting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'introduction' => $this->faker->text,
            'cover_letter_path' => $this->faker->imageUrl(),
            'cv_path' => $this->faker->imageUrl(),
            'user_id' => User::factory()->create()->id,
            'job_posting_id' => JobPosting::factory()->create()->id,
        ];
    }
}
