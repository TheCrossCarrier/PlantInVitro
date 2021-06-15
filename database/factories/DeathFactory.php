<?php

namespace Database\Factories;

use App\Models\Death;
use App\Models\DeathCause;
use App\Models\Plant;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeathFactory extends Factory
{
    protected $model = Death::class;

    public function definition()
    {
        return [
            'plant_id' => $this->faker->unique()->randomElement(Plant::pluck('id')),
            'cause_id' => $this->faker->optional(0.67)->randomElement(DeathCause::pluck('id')),
        ];
    }
}
