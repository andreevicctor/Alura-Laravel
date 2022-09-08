<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagemSucesso = session('mensagem.sucesso');
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create($request->all()); // o ::create já retorna a model criada
//      Serie::create($request->only(['nome'])); traz somente os campos do only(['campo1','campo2'])
//      Serie::create($request->except(['_token'])); traz todos os campos exceto os informados no array
//      to_route e a melhor maneira para redirecionar
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!"); 
    }

    // /series/{series}/edit
    public function edit(Serie $series)
    {
        return view('series.edit')->with('series', $series);
    }

    // /series/{series}
    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all()); // atualiza todos os dados enviado no request (mass assignment)
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->nome} atualizada com sucesso!");
    }

    // /series/destroy/{series}, passando a Model Serie como parametro o laraval faz um: Serie::find($series->id)
    // o parametro series da action(nesse caso a destroy) tem que ser igual o parametro da rota
    public function destroy(Serie $series)
    {
        //dd($request->route()); // para pegar os parametros da rota, entre outras informações
        $series->delete();
        // a Flash message dura só 1 request na sessao
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }
}
