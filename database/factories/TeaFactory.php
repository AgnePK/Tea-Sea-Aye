<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tea>
 */
class TeaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'brand' => $this->faker->text(5),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 10, 15),
            'tea_img' => "public/images/lyons_tea.jpeg",
            'location' => $this->faker->text(10),
        ];
    }
}
