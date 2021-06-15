<?php

namespace Database\Factories;

use App\Models\ContainerType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerTypeFactory extends Factory
{
    protected $model = ContainerType::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
