<?php

namespace App\Http\Controllers;

use App\Models\Medium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MediumController extends Controller
{
    public function index()
    {
        return view('medium.index', []);
    }

    public function create()
    {
        return view('medium.create', []);
    }

    public function store(Request $request)
    {
        # Валидация
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ]);

        # Создание записи в БД    
        try {
            DB::beginTransaction();
            Medium::create([
                'name' => $request->input('name'),
                'short_name' => $request->input('short_name'),
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
