<?php

namespace Database\Factories;

use App\Models\Taxon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaxonFactory extends Factory
{
    protected $model = Taxon::class;

    public function definition()
    {
        return [
            'subspecies' => $this->faker->optional()->passthrough(Str::ucfirst($this->faker->userName())),
            'species' => Str::ucfirst($this->faker->userName()),
            'genus' => $this->faker->optional(0.33)->passthrough(Str::ucfirst($this->faker->userName())),
            'family' => $this->faker->optional()->passthrough(Str::ucfirst($this->faker->userName())),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
