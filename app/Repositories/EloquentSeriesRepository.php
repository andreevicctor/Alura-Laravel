<?php

namespace App\Repositories;

use App\Models\Series;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
/**
 * Essa classe é uma classe de repositório do ORM Eloquent.
 * Isso significa que vai ser uma classe que vai lidar com os detalhes de banco de dados, 
 * então, toda responsabilidade de tratar detalhes do banco de dados pode ser inserido nessa classe.
 */
class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function () use ($request) {
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
    }
}