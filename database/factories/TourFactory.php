<?php

namespace Database\Factories;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;
// use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $properties = Property::all();
        $user = $this->faker->randomElement($users);
        $property = $this->faker->randomElement($properties);
        $dateTime = Carbon::instance($this->faker->dateTimeBetween('now', '+1 month'));
        return [
            //
            'user_id' => $user->id,
            'property_id' => $property->id,
            'tour_date' => $dateTime->format('Y-m-d'),
            'tour_time' => $dateTime->format('H:00:00'),
        ];
    }
}
