<?php

namespace App\Providers;

use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;

class SeriesRepositoryProvider extends ServiceProvider
{
    /**
     * Dessa forma eu estou ligando a interface SeriesRepository a implementação EloquentSeriesRepository
     * Com isso, estamos dizendo que sempre que precisar de uma instância do tipo SeriesRepository, 
     * instancie o EloquentSeriesRepository, o service container sabe o que deve ser feito para isso.
     */
    public array $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
    ];
}
