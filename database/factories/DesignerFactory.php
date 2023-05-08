<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Designer>
 */
class DesignerFactory extends Factory
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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            "age" => $this->faker->numberBetween(24, 50),
            "address" => $this->faker->city(),
            "experience" =>$this->faker->numberBetween(3,9),
            "phone_number" =>$this->faker->phoneNumber(),
            "bio" => $this->faker->text(),
            "linkedin" => $this->faker->name()
            
        ];
    }
}
