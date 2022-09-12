<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::all();
        $mensagemSucesso = session('mensagem.sucesso');
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = DB::transaction(function () use ($request) {
            $serie = Series::create($request->all()); // o ::create já retorna a model criada
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }
            Season::insert($seasons);
    
            $episodes = [];
            foreach($serie->seasons as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];
                }
            }
            Episode::insert($episodes);

            return $serie;
        });
        
//      Series::create($request->only(['nome'])); traz somente os campos do only(['campo1','campo2'])
//      Series::create($request->except(['_token'])); traz todos os campos exceto os informados no array
//      to_route e a melhor maneira para redirecionar
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso!"); 
    }

    // /series/{series}/edit
    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    // /series/{series}
    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all()); // atualiza todos os dados enviado no request (mass assignment)
        $series->save();
        return to_route('series.index')->with('mensagem.sucesso', "Série {$series->nome} atualizada com sucesso!");
    }

    // /series/destroy/{series}, passando a Model Series como parametro o laraval faz um: Series::find($series->id)
    // o parametro series da action(nesse caso a destroy) tem que ser igual o parametro da rota
    public function destroy(Series $series)
    {
        //dd($request->route()); // para pegar os parametros da rota, entre outras informações
        $series->delete();
        // a Flash message dura só 1 request na sessao
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso!");
    }
}
