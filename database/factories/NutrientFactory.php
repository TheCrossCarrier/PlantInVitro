<?php

namespace Database\Factories;

use App\Models\Nutrient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutrientFactory extends Factory
{
    protected $model = Nutrient::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'concentration' => $this->faker->randomFloat(2, 0, 5),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
