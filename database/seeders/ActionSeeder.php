<?php

namespace Database\Seeders;

use App\Models\Taxon;
use App\Models\Location;
use App\Models\Plant;
use App\Models\Action;
use App\Models\Component;
use App\Models\ComponentType;
use App\Models\Container;
use App\Models\Death;
use App\Models\DeathCause;
use App\Models\ExplantType;
use App\Models\Medium;
use App\Models\MediumComposition;
use App\Models\Nutrient;
use App\Models\Nutrition;
use App\Models\Planting;
use App\Models\Relation;
use App\Models\Relocation;
use App\Models\SterilizationMode;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    public function run()
    {
        Taxon::factory(5)->create();
        ExplantType::factory(3)->create();
        DeathCause::factory(3)->create();
        Nutrient::factory(8)->create();
        Location::factory(3)->create();
        ComponentType::factory(5)->create();
        Component::factory(15)->create();
        SterilizationMode::factory(4)->create();
        Medium::factory(3)->create();

        foreach (Medium::pluck('id') as $medium_id) {
            $component_ids = Component::pluck('id');
            $medium_component_ids = [];
            for ($i = 0; $i < mt_rand(3, 6); $i++) {
                $keys = $component_ids->keys()->random();
                $medium_component_ids[] = $component_ids->pull($keys);
            }

            foreach ($medium_component_ids as $component_id) {
                MediumComposition::factory()->create([
                    'medium_id' => $medium_id,
                    'component_id' => $component_id,
                ]);
            }
        }

        # Начальные растения
        $initial_plantings = 10;
        Action::factory($initial_plantings)->create(['type_id' => 1]);

        Action::factory(12)->create();
        # Распределение созданных действий по подтаблицам
        foreach (Action::pluck('id') as $action_id) {
            switch (Action::where('id', $action_id)->get()->sortBy('id')->first()->type_id) {
                # Посадка/Пересадка
                case 1: # ActionTypeSeeder::$types
                    # Посадка
                    if ($initial_plantings || mt_rand(1, 4) == 4 || !Plant::pluck('id')->first()) {
                        $plant = Plant::factory()->create();
                        $container = Container::factory()->create();
                        Planting::factory()->create([
                            'action_id' => $action_id,
                            'plant_id' => $plant->id,
                            'container_id' => $container->id,
                        ]);

                        if (Plant::all()->count() > 1) {
                            Relation::factory()->create([
                                'parent_id' => Plant::pluck('id')->filter(fn ($value) => $value != $plant->id)->random(),
                                'child_id' => $plant->id,
                            ]);
                        }

                        $initial_plantings--;
                    # Пересадка
                    } else {
                        Planting::factory()->create(['action_id' => $action_id]);
                    }
                    break;

                # Гибель
                case 2: # ActionTypeSeeder::$types
                    Death::factory()->create(['action_id' => $action_id]);
                    break;

                # Подпитка
                case 3: # ActionTypeSeeder::$types
                    Nutrition::factory()->create(['action_id' => $action_id]);
                    break;

                # Релокация
                case 4: # ActionTypeSeeder::$types
                    Relocation::factory()->create(['action_id' => $action_id]);
                    break;

                default:
                    break;
            }
        }
    }
}
