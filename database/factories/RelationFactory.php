<?php

namespace Database\Factories;

use App\Models\Relation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelationFactory extends Factory
{
    protected $model = Relation::class;

    public function definition()
    {
        return [
            
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
