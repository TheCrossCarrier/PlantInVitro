<?php

namespace Database\Factories;

use App\Models\MediumComposition;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediumCompositionFactory extends Factory
{
    protected $model = MediumComposition::class;

    public function definition()
    {
        return [
            'concentration' => $this->faker->optional(0.33)->randomFloat(2, 0, 5),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
