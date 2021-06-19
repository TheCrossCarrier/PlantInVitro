<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Container;
use App\Models\Plant;
use App\Models\Planting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransplantController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int $plant_id
     * @return \Illuminate\Http\Response
     */
    public function create($plant_id)
    {
        $container_ids = Container::pluck('id')
            ->reject(fn ($container_id) => $container_id === Plant::find($plant_id)->containers->last()->id)
            ->sort();

        return view('plants.transplant', compact('plant_id', 'container_ids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $plant_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $plant_id)
    {
        PlantController::plantExistsCheck($plant_id);
        PlantController::plantAliveCheck($plant_id);

        $prev_transplantings = Planting::where('plant_id', '=', $plant_id)
            ->join('actions', 'actions.id', '=', 'plantings.action_id')
            ->where('date', '<', $request->input('date_time'))
            ->orderBy('date')
            ->get();
            // ->filter(fn ($planting) => $planting->action->date < $request->input('date'));

dd($prev_transplantings->last()->id);

        if ($request->input('container_id') === Planting::where('container_id', '=', $prev_transplantings->last()->id)) {
            abort(400, "Нельзя пересадить растение в тот же контейнер (номер $request->input('container_id').");
        }

        $validatedRequest = $request->validate([
            'date_time' => 'required|date',
            'container_id' => 'required|integer|min:1',
            'comment' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $action = Action::create([
                'type_id' => '5',
                'date' => $validatedRequest['date_time'],
                'comment' => $validatedRequest['comment'],
                'user_id' => Auth::id(),
            ]);

            Planting::create([
                'action_id' => $action->id,
                'plant_id' => $plant_id,
                'container_id' => $validatedRequest['container_id'],
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            abort(500, $e->getMessage());
        }
        DB::commit();

        return back()->withSuccess(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
