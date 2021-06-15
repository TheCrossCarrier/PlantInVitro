<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Plant;
use App\Models\Planting;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlantingFactory extends Factory
{
    protected $model = Planting::class;

    public function definition()
    {
        return [
            'plant_id' => $this->faker->randomElement(Plant::pluck('id')
                ->filter(fn ($plant_id) => !Plant::find($plant_id)->death)),

            'container_id' => $this->faker->randomElement(Container::pluck('id')),
        ];
    }
}
