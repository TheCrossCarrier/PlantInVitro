<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PresetSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ContainerTypeSeeder::class,
            ActionTypeSeeder::class,
        ]);
    }
}
