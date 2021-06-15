<?php

namespace Database\Seeders;

use App\Models\ContainerType;
use Illuminate\Database\Seeder;

class ContainerTypeSeeder extends Seeder
{
    public static $types = [
        'Чашка Петри',
        'Бокс',
        'Пластиковый стаканчик',
    ];

    public function run()
    {
        foreach (self::$types as $type) {
            ContainerType::factory()->create(['name' => $type]);
        }
    }
}
