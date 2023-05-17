<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   

        $status = $this->faker->randomElement(["pending", "listed"]);
        $requested_date = $this->faker->dateTimeThisDecade();
        return [
            "user_id" =>User::factory(),
            "buyer_id" => $status =="sold" ? User::factory() : NULL,
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(30000,300000),
            "description" => $this->faker->text(),
            "province" =>$this->faker->randomElement(["Akkar", "Baalbeck", "Beirut", "Bekaa", "Mount Lebanon", "North Lebanon", "Nabatiyeh", "South Lebanon"]),
            "city" =>$this->faker->city(),
            "street" =>$this->faker->streetName(),
            "latitude" =>$this->faker->randomFloat(5,33.382030 , 34.556198),
            "longitude" =>$this->faker->randomFloat(5,35.718208, 36.105202),
            "type" =>$this->faker->randomElement(["apartments", "flat", "house", "villa"]),
            'parking' => $this->faker->numberBetween(0,2),
            'bedrooms' => $this->faker->numberBetween(1,5),
            'bathrooms' => $this->faker->numberBetween(1,4),
            'area' => $this->faker->numberBetween(80,220),
            "built_in" =>$this->faker->year(),
            "buy_or_rent" =>$this->faker->randomElement(["buy", "rent"]),
            "status" =>$status,
            "requested_date" =>$requested_date,
            "sold_date" => $status =="sold" ? $this->faker->dateTimeBetween($requested_date,"now") : NULL,

        ];
    }
}