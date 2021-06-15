<?php

namespace Database\Seeders;

use App\Models\ActionType;
use Illuminate\Database\Seeder;

class ActionTypeSeeder extends Seeder
{
    public static $types = [
        'Посадка',
        'Гибель',
        'Подпитка',
        'Релокация',
    ];

    public function run()
    {
        foreach (self::$types as $type) {
            ActionType::create(['name' => $type]);
        }
    }
}
