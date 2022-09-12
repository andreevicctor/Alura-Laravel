<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false; // nao estou usando timestamps
    protected $fillable = ['number'];

    public function season() // funcao de relacionamento com a model Season 
    {
//      Um episodio pertence a uma temporada
        return $this->belongsTo(Season::class);
    }
}
