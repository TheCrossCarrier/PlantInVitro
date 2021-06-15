<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    public function index($id)
    {
        return view('location', []);
    }

    public function create()
    {
        return view('location.create', []);
    }

    public function store(Request $request)
    {
        # Валидация
        $request->validate([
            'name' => 'required',
        ]);

        # Создание записи в БД
        try {
            DB::beginTransaction();
            Location::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return Redirect::back()
                ->withErrors('Ошибка запроса: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            return Redirect::back()
                ->withErrors($e->getMessage());
        }
        DB::commit();

        return Redirect::back()
            ->with('success', true);
    }
}
