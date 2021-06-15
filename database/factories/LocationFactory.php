<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    protected $model = Location::class;

    public function definition()
    {
        return [
            'name' => $this->faker->streetName(),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
