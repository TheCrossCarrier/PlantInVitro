<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\Location;
use App\Models\Relocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelocationFactory extends Factory
{
    protected $model = Relocation::class;

    public function definition()
    {
        return [
            'container_id' => $this->faker->randomElement(Container::pluck('id')),
            'location_id' => $this->faker->randomElement(Location::pluck('id')),
        ];
    }
}
