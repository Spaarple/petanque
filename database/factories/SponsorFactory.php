<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{

    protected $model = \App\Models\Sponsor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sponsor_name' => $this->faker->company(),
            'sponsor_description' => $this->faker->paragraph(),
            'sponsor_logo' => $this->faker->imageUrl(),
            'sponsor_website' => $this->faker->url(),
            'sponsor_subscription_end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
