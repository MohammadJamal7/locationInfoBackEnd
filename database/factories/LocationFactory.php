<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'latitude' => $this->faker->latitude,  // Generates a random latitude
            'longitude' => $this->faker->longitude, // Generates a random longitude
            'ip' => $this->faker->ipv4, // Generates a random IP address
        ];
    }
}
