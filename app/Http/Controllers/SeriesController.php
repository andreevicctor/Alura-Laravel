<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('nome')->get();
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());
//      Serie::create($request->only(['nome'])); traz somente os campos do only(['campo1','campo2'])
//      Serie::create($request->except(['_token'])); traz todos os campos exceto os informados no array
        return to_route('series.index'); // to_route e a melhor maneira para redirecionar
    }
}
