<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPosting>
 */
class JobPostingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory()->create()->id,
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->catchPhrase,
            'cv_required' => $this->faker->boolean,
            'cover_letter_required' => $this->faker->boolean,
            'location' => $this->faker->country,
            'job_type' => $this->faker->randomElement(['remote', 'hybrid', 'full time']),
            'expires_at' => $this->faker->date(),
            'min_salary' => $this->faker->numberBetween($min = 100000, $max = 150000),
            'max_salary' => $this->faker->numberBetween($min = 1500001, $max = 500000),
        ];
    }
}
