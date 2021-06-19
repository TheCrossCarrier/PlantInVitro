<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Death;
use App\Models\DeathCause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeathController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param  int $plant_id
     * @return \Illuminate\Http\Response
     */
    public function create($plant_id)
    {
        PlantController::plantExistsCheck($plant_id);
        PlantController::plantAliveCheck($plant_id);

        $causes = DeathCause::pluck('name', 'id');

        return view('plants.death', compact('plant_id', 'causes'));
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
        $request->validate([
            'date_time' => 'required|date',
            'cause_id' => 'nullable|integer|min:1',
            'comment' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $action = Action::create([
                'type_id' => '2',
                'date' => $request->input('date_time'),
                'comment' => $request->input('comment'),
                'user_id' => Auth::id(),
            ]);

            Death::create([
                'action_id' => $action->id,
                'plant_id' => $plant_id,
                'cause_id' => $request->input('cause_id'),
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
