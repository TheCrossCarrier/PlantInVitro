<?php

namespace Database\Factories;

use App\Models\Component;
use App\Models\ComponentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComponentFactory extends Factory
{
    protected $model = Component::class;

    public function definition()
    {
        return [
            'name' => Str::ucfirst($this->faker->name()),
            'chemical_name' => Str::upper($this->faker->word()) . $this->faker->randomDigit(),
            'type_id' => $this->faker->randomElement(ComponentType::pluck('id')),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
