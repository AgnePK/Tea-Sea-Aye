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
        // Using faker to populate my DB with random data.
        return [
            'name' => $this->faker->word,
            // 'uuid' => $this->faker->uuid(),
            // 'brand' => $this->faker->text(5),
            'description' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2, 10, 15), 
            'tea_img' => "24-10-2022_lyons_tea2",
            // 'user_id'=> '1',
            // 'location' => "dublin",
            'location' => $this->faker->text(10),
            // 'brand_id' => $this->faker->numberBetween($min = 1, $max = 5)
            //not working- random id not changing, hard coding not changing from 1 either.
            'brand_id' => '2'
        ];
    }
}
