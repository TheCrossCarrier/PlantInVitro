<?php

namespace Database\Factories;

use App\Models\DeathCause;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DeathCauseFactory extends Factory
{
    protected $model = DeathCause::class;

    public function definition()
    {
        return [
            'name' => Str::ucfirst($this->faker->word()),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
