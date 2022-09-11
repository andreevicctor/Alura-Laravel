<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    public $timestamps = false; // nao estou usando timestamps

    public function season()
    {
//      Um episodio pertence a uma temporada
        return $this->belongsTo(Season::class);
    }
}
