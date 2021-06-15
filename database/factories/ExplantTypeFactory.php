<?php

namespace Database\Factories;

use App\Models\ExplantType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExplantTypeFactory extends Factory
{
    protected $model = ExplantType::class;

    public function definition()
    {
        return [
            'name' => Str::ucfirst($this->faker->word()),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
