<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Container;
use App\Models\ContainerType;
use App\Models\Death;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plants = Plant::all();
        $Container = Container::class;

        return view('plants.index', compact('plants', 'Container'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $container_types = ContainerType::pluck('name', 'id');
        $media = Medium::pluck('name', 'id');
        $taxa = Taxon::all();
        $locations = Location::pluck('name', 'id');

        return view('plants.create', compact(
            'container_types',
            'media',
            'taxa',
            'locations',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $container_id = $request->input('container_id');
        if ($container_id && Container::find($container_id)) {
            abort(400, 'Номер контейнера ' . $container_id . ' уже занят.');
        }

        $validatedRequest = $request->validate([
            'name' => 'required|string|max:255',
            'date_time' => 'required|date',
            'taxon_id' => 'required|integer|min:1',
            'container_id' => 'nullable|integer|min:1',
            'container_type_id' => 'required|integer|min:1',
            'medium_id' => 'required|integer|min:1',
            'img' => 'file|mimes:jpg,jpeg,png',
            'description' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        # Plant image handling
        $new_img_filename = null;
        if ($request->hasFile('img')) {
            $new_img_filename = uniqid() . '-' . $request->name . '.' . $request->img->extension();
            $request->file('img')->storeAs('public/img', $new_img_filename);
        }

        try {
            DB::beginTransaction();
            $plant = Plant::create(array_merge(
                $validatedRequest,
                [
                    'img_filename' => $new_img_filename,
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

            if ($request->input('location_id')) {
                $action_relocate = Action::create([
                    'type_id' => 4, # ActionTypeSeeder::$types
                    'date' => $request->input('date_time'),
                    'user_id' => Auth::id(),
                ]);

                Relocation::create([
                    'action_id' => $action_relocate->id,
                    'container_id' => $container->id,
                    'location_id' => $request->input('location_id'),
                ]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return abort(500, $e->getMessage());
        }
        DB::commit();

        return back()
            ->withSuccess(true)
            ->with('plant_id', $plant->id)
            ->with('container_id', $container->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->plantExistsCheck($id);

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

        $actions = collect([...$plant->plantings, $plant->death, ...$relocations, ...$nutrition])
            ->reject(fn ($value) => is_null($value))
            ->sortBy('date');

        $last_container = $plant->containers->last();
        $last_relocation = $last_container->relocations->last();
        $img_path = $plant->img_filename ? Storage::url('img/' . $plant->img_filename) : null;
        $Container = Container::class;

        return view('plants.show', compact(
            'plant',
            'actions',
            'last_container',
            'last_relocation',
            'img_path',
            'Container',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->plantExistsCheck($id);
        $this->plantAliveCheck($id);

        $plant = Plant::find($id);

        return view('plants.edit', compact('plant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->plantExistsCheck($id);
        $this->plantAliveCheck($id);

        $validatedRequest = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Plant::find($id)->update($validatedRequest);

        return redirect(route('plants.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Check if plant not exist and throw an exception if not.
     * 
     * @param int $id
     * @throws \HttpResponseException
     */
    public static function plantNotExistCheck($id)
    {
        if (Validator::make([$id], [Rule::in(Plant::pluck('id'))])->fails()) {
            abort(400, "Растение под номером $id уже существует.");
        }
    }

    /**
     * Check if plant exists and throw an exception if not.
     * 
     * @param int $id
     * @throws \HttpResponseException
     */
    public static function plantExistsCheck($id)
    {
        if (Validator::make([$id], [Rule::in(Plant::pluck('id'))])->fails()) {
            abort(404, "Растение под номером $id не найдено.");
        }
    }

    /**
     * Check if plant is alive and throw an exception if not.
     * 
     * @param int $id
     * @throws \HttpResponseException
     */
    public static function plantAliveCheck($id)
    {
        if (Validator::make([$id], [Rule::notIn(Death::pluck('plant_id'))])->fails()) {
            abort(400, "Растение под номером $id имеет статус погибшего.");
        }
    }
}
