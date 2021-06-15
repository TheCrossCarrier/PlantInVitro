<?php

namespace Database\Factories;

use App\Models\Medium;
use App\Models\SterilizationMode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MediumFactory extends Factory
{
    protected $model = Medium::class;

    public function definition()
    {
        return [
            'name' => $this->faker->userName(),
            'short_name' => Str::ucfirst($this->faker->word()) . $this->faker->randomDigit(),
            'sterilization_mode_id' => $this->faker->randomElement(SterilizationMode::pluck('id')),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
