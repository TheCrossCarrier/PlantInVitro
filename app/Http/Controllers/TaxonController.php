<?php

namespace App\Http\Controllers;

use App\Models\Taxon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaxonController extends Controller
{
    public function index()
    {
        return view('taxon.index', []);
    }

    public function create()
    {
        return view('taxon.create', []);
    }

    public function store(Request $request)
    {
        # Валидация
        $validatedRequest = $request->validate([
            'family' => 'nullable|string',
            'genus' => 'nullable|string',
            'species' => 'nullable|string|required_without:subspecies',
            'subspecies' => 'nullable|string|required_without:species',
        ]);

        # Создание записи в БД
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
}
