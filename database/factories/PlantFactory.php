<?php

namespace Database\Factories;

use App\Models\Plant;
use App\Models\Taxon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class PlantFactory extends Factory
{
    protected $model = Plant::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'taxon_id' => $this->faker->randomElement(Taxon::pluck('id')),
            'img_filename' => $this->faker->optional(0.75)
                ->randomElement(collect(File::files(public_path("\img\database\seeding")))
                    ->map(fn ($file) => $file->getFilename())),
            'description' => $this->faker->text(),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
