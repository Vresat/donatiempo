<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->realText(20),
            'body'=>fake()->realText(3000),
            'city'=>fake()->realText(10),
            'active'=> true,
            'user_id'=>random_int(1,2),
            'category_id'=>random_int(1,3)
        ];
    }
}
