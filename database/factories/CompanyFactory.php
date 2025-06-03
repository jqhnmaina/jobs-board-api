<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
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
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
