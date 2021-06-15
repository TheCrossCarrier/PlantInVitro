<?php

namespace Database\Factories;

use App\Models\Action;
use App\Models\ActionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActionFactory extends Factory
{
    protected $model = Action::class;

    public function definition()
    {
        return [
            'type_id' => $this->faker->randomElement(ActionType::pluck('id')),
            'date' => $this->faker->dateTimeBetween('-2 years'),
            'comment' => $this->faker->optional(0.25)->sentence(),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
