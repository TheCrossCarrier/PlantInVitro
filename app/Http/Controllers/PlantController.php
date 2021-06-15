<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Death;
use App\Models\DeathCause;
use App\Models\Location;
use App\Models\Medium;
use App\Models\Plant;
use App\Models\Planting;
use App\Models\Relocation;
use App\Models\Taxon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlantController extends Controller
{
    # Метод, работающий со страницей растения
    public function index($id)
    {
        $plant = Plant::find($id);

        $nutrition = [];
        $relocations = [];
        foreach ($plant->containers as $container) {
            foreach ($container->nutrition as $nutritionEl) {
                $nutrition[] = $nutritionEl;
            }
            foreach ($container->relocations as $relocationsEl) {
                $relocations[] = $relocationsEl;
            }
        }

        # Слияние всех действий в один массив и удаление null элементов
        $actions = collect([...$plant->plantings, $plant->death, ...$relocations, ...$nutrition])
            ->reject(fn ($value) => is_null($value))
            ->sortBy('date');

        $last_container = $plant->containers->last();
        $last_relocation = $last_container->relocations->last();

        $img_path = $plant->img_filename ? Storage::url('img/' . $plant->img_filename) : null;

        $Container = Container::class;

        return view('plant.index', compact(
            'plant',
            'actions',
            'last_container',
            'last_relocation',
            'img_path',
            'Container',
        ));
    }

    # Метод, работающий со страницей создания растения
    public function create()
    {
        $container_types = ContainerType::pluck('name', 'id');

        $media = Medium::pluck('name', 'id');

        $taxa = Taxon::all();

        $locations = Location::pluck('name', 'id');

        return view('plant.create', compact(
            'container_types',
            'media',
            'taxa',
            'locations',
        ));
    }

    # Метод, создающий запись в БД о растении и его атрибутах
    public function store(Request $request)
    {
        $container_id = $request->input('container_id');
        # Проверка доступности id контейнера (если был задан)
        if ($container_id && Container::find($container_id)) {
            return back()->withErrors('Номер контейнера ' . $container_id . ' уже занят.');
        }

        # Валидация
        $validatedRequest = $request->validate([
            'name' => 'required|string',
            'date_time' => 'required|date',
            'taxon_id' => 'required|integer|min:1',
            'container_id' => 'nullable|integer|min:1',
            'container_type_id' => 'required|integer|min:1',
            'img' => 'file|mimes:jpg,jpeg,png',
        ]);

        # Обработка фото
        $new_img_name = null;
        if ($request->hasFile('img')) {
            $new_img_name = uniqid() . '-' . $request->name . '.' . $request->img->extension();
            $request->file('img')->storeAs('public/img', $new_img_name);
        }

        # Создание записей в БД
        try {
            DB::beginTransaction();
            $plant = Plant::create(array_merge(
                $validatedRequest,
                [
                    'img_filename' => $new_img_name,
                    'user_id' => Auth::id(),
                ],
            ));

            $container = Container::create([
                'id' => $container_id,
                'type_id' => $request->input('container_type_id'),
                'medium_id' => $request->input('medium_id'),
                'user_id' => Auth::id(),
            ]);

            $action = Action::create([
                'type_id' => 1,
                'date' => $request->input('date_time'),
                'comment' => $request->input('comment'),
                'user_id' => Auth::id(),
            ]);

            Planting::create([
                'action_id' => $action->id,
                'plant_id' => $plant->id,
                'container_id' => $container->id,
            ]);

            if ($request->location_id) {
                $action_relocate = Action::create([
                    'type_id' => 4, # ActionTypeSeeder::$types
                    'date' => $request->input('date_time'),
                ]);

                Relocation::create([
                    'action_id' => $action_relocate->id,
                    'container_id' => $container->id,
                    'location_id' => $request->input('location_id'),
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return back()
                ->withErrors('Ошибка запроса: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withErrors($e->getMessage());
        }
        DB::commit();

        return back()
            ->withSuccess(true)
            ->with('plant_id', $plant->id)
            ->with('container_id', $container->id);
    }

    # Метод, работающий со страницей редактирования информации о растении
    public function edit($id)
    {
        $this->existsOrDeadCheck($id);

        $plant = Plant::find($id);

        return view('plant.edit', compact('plant'));
    }

    # Метод, обновляющий информацию о растении в БД
    public function update(Request $request, $id)
    {
        $this->existsOrDeadCheck($id);

        $validatedRequest = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Plant::find($id)->update($validatedRequest);

        return redirect(route('plant.index', $id));
    }

    # Метод, работающий со страницей занесения данных о гибели растения
    public function died($id)
    {
        $this->existsOrDeadCheck($id);

        $causes = DeathCause::pluck('name', 'id');

        return view('plant.died', compact('id', 'causes'));
    }

    # Метод, сохраняющий информацию о гибели растении в БД
    public function storeDeath(Request $request, $id)
    {
        $this->existsOrDeadCheck($id);

        $request->validate([
            'date_time' => 'required|date',
            'cause_id' => [
                'nullable',
                'integer',
                Rule::in(DeathCause::pluck('id')),
            ],
            'comment' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $action = Action::create([
                'type_id' => '2',
                'date' => $request->date_time,
                'comment' => $request->comment,
                'user_id' => Auth::id(),
            ]);

            Death::create([
                'action_id' => $action->id,
                'plant_id' => $id,
                'cause_id' => $request->cause_id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return back()
                ->withErrors('Ошибка запроса: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->withErrors($e->getMessage());
        }
        DB::commit();

        return back()->withSuccess(true);
    }

    public function transplant($id)
    {
        $this->existsOrDeadCheck($id);
        $container_ids = Container::pluck('id')
            ->reject(fn ($container_id) => $container_id === Plant::find($id)->containers->last()->id)
            ->sort();

        return view('plant.transplant', compact('id', 'container_ids'));
    }

    public function storeTransplantation(Request $request, $id)
    {
        $this->existsOrDeadCheck($id);
        if ($request->container_id === Plant::find($id)->containers->last()->id) {
            abort(404);
        }

        $request->validate([
            'date_time' => 'required|date',
            'container_id' => [
                'nullable',
                'integer',
                Rule::notIn(Plant::find($id)->containers->last()->id),
            ],
            'comment' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $action = Action::create([
                'type_id' => '5',
                'date' => $request->date_time,
                'comment' => $request->comment,
                'user_id' => Auth::id(),
            ]);

            Planting::create([
                'action_id' => $action->id,
                'plant_id' => $id,
                'container_id' => $request->container_id,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            dd($e->getMessage());
            return back()
                ->withErrors('Ошибка запроса: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return back()
                ->withErrors($e->getMessage());
        }
        DB::commit();

        return back()->withSuccess(true);
    }

    public function existsOrDeadCheck($id)
    {
        if (
            Validator::make([$id], [
                Rule::in(Plant::pluck('id')),
                Rule::notIn(Death::pluck('plant_id')),
            ])->fails()
        ) {
            abort(404);
        }
    }
}
