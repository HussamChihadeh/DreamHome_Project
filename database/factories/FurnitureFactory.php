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
        $style = $this->faker->randomElement(["Traditional", "Modern", "Industrial", "Rustic", "Mid-century modern"]);
        $type = $this->faker->randomElement(["Sofas", "Chairs", "Tables", "Beds", "Desks"]);
        return [
            //
            "designer_id" => Designer::factory(),
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(500,3500),
            "date" => $this->faker->dateTimeThisDecade(),
            "style" =>$style,
            "type" =>$type,
            "material" =>$this->faker->randomElement(["cowhide", "suede", "cotton", "polyster"]),
            "place" => $this->faker->country(),
            "quantity" => $this->faker->numberBetween(1, 50),
            "description" => $this->faker->text(),
        ];
    }
}
