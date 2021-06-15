<?php

namespace Database\Factories;

use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Medium;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{
    protected $model = Container::class;

    public function definition()
    {
        return [
            'type_id' => $this->faker->randomElement(ContainerType::pluck('id')),
            'medium_id' => $this->faker->randomElement(Medium::pluck('id')),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
