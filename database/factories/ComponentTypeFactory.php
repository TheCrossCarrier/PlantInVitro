<?php

namespace Database\Factories;

use App\Models\ComponentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComponentTypeFactory extends Factory
{
    protected $model = ComponentType::class;

    public function definition()
    {
        return [
            'name' => Str::ucfirst($this->faker->userName()),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
