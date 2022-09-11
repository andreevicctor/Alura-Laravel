<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function temporadas()
    {
//      Uma serie possui varias temporadas
        return $this->hasMany(Season::class, 'series_id');
    }

    // criando um scope global de ordenacao
    // com o metodo booted() quando a model é inicializada o scopo é adicionado
    protected static function booted()
    {
        self::addGlobalScope('ordered', function(Builder $queryBuilder) {
            $queryBuilder->orderBy('nome');
        });
    }

}
