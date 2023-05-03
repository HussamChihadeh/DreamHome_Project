<?php

namespace Database\Factories;
use App\Models\Designer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
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
            'content' => $this->faker->messages(),
            "user_id" => User::factory(),
            'Designer_Side' => $this->faker->numberBetween(0,1),
           
        ];
    }
}