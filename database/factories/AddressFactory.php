<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'cep' => fake()->postcode(),
            'number' => fake()->buildingNumber(),
            'client_id' => \App\Models\Client::factory()
        ];
    }
}
