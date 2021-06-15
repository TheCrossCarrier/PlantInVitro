<?php

namespace Database\Factories;

use App\Models\Explant;
use App\Models\ExplantType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExplantFactory extends Factory
{
    protected $model = Explant::class;

    public function definition()
    {
        return [
            'explant_type_id' => $this->faker->randomElement(ExplantType::pluck('id')),
        ];
    }
}
