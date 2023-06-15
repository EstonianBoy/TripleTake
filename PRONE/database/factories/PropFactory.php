<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prop>
 */
class PropFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Name' => $this->faker->name,
            'Price' => random_int(263000, 572000),
            'Bedrooms' => random_int(3, 5),
            'Bathrooms' => random_int(2, 3),
            'Storeys' => random_int(1, 2),
            'Garages' => random_int(1, 2)
        ];
    }
}
