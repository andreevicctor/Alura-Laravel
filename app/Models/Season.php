<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function series()
    {
//      Uma temporada pertence a uma serie
        return $this->belongsTo(Serie::class);
    }

    public function episodes()
    {
//      Uma temporada possui varios episodios
        return $this->hasMany(Episode::class);
    }
}
