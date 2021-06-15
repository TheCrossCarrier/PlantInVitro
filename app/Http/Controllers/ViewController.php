<?php

namespace App\Http\Controllers;

use App\Models\Container;
use App\Models\Plant;

class ViewController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        $Container = Container::class;

        return view('view', compact('plants', 'Container'));
    }
}
