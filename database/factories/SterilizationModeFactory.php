<?php

namespace Database\Factories;

use App\Models\SterilizationMode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SterilizationModeFactory extends Factory
{
    protected $model = SterilizationMode::class;

    public function definition()
    {
        return [
            'name' => Str::ucfirst($this->faker->word()),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
