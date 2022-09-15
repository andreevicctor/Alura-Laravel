<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    public function series() // funcao de relacionamento com a model Series
    {
        /**
         * Uma temporada pertence a uma Serie
         */
        return $this->belongsTo(Series::class);
    }

    public function episodes() // funcao de relacionamento com a model Episode
    {
        /**
         * Uma temporada possui varios episodios
         */
        return $this->hasMany(Episode::class);
    }
    /**
     * Retornando o numero de episodios assistidos
     */
    public function numberOfWatchedEpisodes(): int
    {
        return $this->episodes->filter(fn ($episode) => $episode->watched)->count();
    }
}
