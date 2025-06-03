<?php

namespace Database\Factories;

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
            'owner_id' => User::factory()->create()->id,
            'name' => $this->faker->company,
            'description' => $this->faker->catchPhrase,
            'website' => $this->faker->url,
            'cv_required' => $this->faker->boolean,
            'cover_letter_required' => $this->faker->boolean,
            'location' => $this->faker->address,
            'min_salary' => $this->faker->numberBetween($min = 100000, $max = 150000),
            'max_salary' => $this->faker->numberBetween($min = 1500001, $max = 500000),
        ];
    }
}
