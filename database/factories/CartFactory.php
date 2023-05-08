<?php

namespace Database\Factories;

use App\Models\Furniture;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $furnitures = Furniture::all();
        $user = $this->faker->randomElement($users);
        $furniture = $this->faker->randomElement($furnitures);
        return [
           
            'user_id' => $user->id,
            'furniture_id' => $furniture->id,
            'quantity' => $this->faker->numberBetween(1,9),
          
        ];
    }   
}
