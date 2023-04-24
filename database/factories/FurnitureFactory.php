<?php

namespace Database\Factories;
use App\Models\Designer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Furniture>
 */
class FurnitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "designer_id" => Designer::factory(),
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(500,3500),
            "date" => $this->faker->dateTimeThisDecade(),
            "style" =>$this->faker->name(),
            "material" =>$this->faker->randomElement(["cowhide", "suede", "cotton", "polyster"]),
            "place" => $this->faker->country(),
            "quantity" => $this->faker->numberBetween(1, 50),
            "description" => $this->faker->text(),
        ];
    }
}
