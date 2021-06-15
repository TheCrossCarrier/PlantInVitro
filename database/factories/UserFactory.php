<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
            'remember_token' => $this->faker->optional(0.67)->passthrough(Str::random(60)),
        ];
    }
}
