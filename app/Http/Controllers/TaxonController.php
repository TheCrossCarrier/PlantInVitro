<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Taxon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaxonController extends Controller
{
    /**
     * Rules for the validator.
     * 
     * @var array
     */
    private $validationRules = [
        'family' => 'nullable|string|max:255',
        'genus' => 'nullable|string|max:255',
        'species' => 'nullable|string|max:255|required_without:subspecies',
        'subspecies' => 'nullable|string|max:255|required_without:species',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('taxa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('taxa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate($this->validationRules);

        try {
            DB::beginTransaction();
            Taxon::create(array_merge(
                $validatedRequest,
                ['user_id' => Auth::id()],
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return back()->withErrors('Ошибка запроса: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors($e->getMessage());
        }
        DB::commit();

        return back()->withSuccess(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('taxa.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taxon = Taxon::find($id);

        return view('taxa.edit', compact('taxon'));
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
        $validatedRequest = $request->validate($this->validationRules);

        Plant::find($id)->update($validatedRequest);

        return redirect(route('taxa.show', $id));
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
