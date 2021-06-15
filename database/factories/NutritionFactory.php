<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Nutrient;
use App\Models\Nutrition;
use Illuminate\Database\Eloquent\Factories\Factory;

class NutritionFactory extends Factory
{
    protected $model = Nutrition::class;

    public function definition()
    {
        return [
            'container_id' => $this->faker->randomElement(Container::pluck('id')),
            'nutrient_id' => $this->faker->randomElement(Nutrient::pluck('id')),
        ];
    }
}
