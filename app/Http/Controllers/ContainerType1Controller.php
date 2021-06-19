<?php

namespace App\Http\Controllers;

use App\Models\ContainerType;
use Illuminate\Http\Request;

class ContainerTypeController extends Controller
{
    public function index($id)
    {
        return view('container-type', []);
    }

    public function create()
    {
        return view('container-type.create', []);
    }

    public function store(Request $request)
    {
        # Валидация
        $request->validate([
            'name' => 'required',
        ]);

        # Создание записи в БД
        try {
            ContainerType::create([
                'name' => $request->input('name'),
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()
                ->withErrors('Ошибка запроса: ' . $e->getMessage());
        } catch (\Exception $e) {
            return back()
                ->withErrors($e->getMessage());
        }

        return back()
            ->with('success', true);
    }
}
