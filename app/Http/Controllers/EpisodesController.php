<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes; // episodios marcados
        DB::transaction(function () use ($watchedEpisodes, $season) {
            if (is_null($watchedEpisodes)) { // se nao vier marcado nenhum episodio
                DB::table('episodes')->where('season_id', $season->id)->update(['watched' => false]);
            }else {
                DB::table('episodes')->where('season_id', $season->id) // episodios nao selecionados
                                    ->whereNotIn('id', $watchedEpisodes)->update(['watched' => false]);
                DB::table('episodes')->where('season_id', $season->id) // episodios selecionados
                                    ->whereIn('id', $watchedEpisodes)->update(['watched' => true]);
            }
        });
        //o codigo acima é uma melhoria do codigo comentado abaixo
        // $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
        //     $episode->watched = in_array($episode->id, $watchedEpisodes);
        // });
        // $season->push();

        return to_route('episodes.index', $season->id)
            ->with('mensagem.sucesso', 'Episódios marcados como assistidos!');
    }
}