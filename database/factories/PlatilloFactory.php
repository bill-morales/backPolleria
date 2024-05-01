<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Platillo>
 */
class PlatilloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 10, 1000),
            'subcategory_id' => Subcategory::all()->random()->id,
        ];
    }
}
