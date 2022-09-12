<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/series');
});
// utilizando o Route::resource para seguir a implementação da documentação
Route::resource('/series', SeriesController::class)->except(['show']);

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

// Route::controller(SeriesController::class)->group(function () {
//     Route::get('/series', 'index')->name('series.index');
//     Route::get('/series/create', 'create')->name('series.create');
//     Route::post('/series/store', 'store')->name('series.store');
//     Route::get('/series/{$series}/edit', 'edit')->name('series.edit');
//     Route::post('/series/{$series}', 'update')->name('series.update'); @method PUT
//     Route::post('/series/{$series}', 'destroy')->name('series.destroy'); @method DELETE
// });
// -- outra forma:
// Route::delete('/series/destroy/{serie}', [SeriesController::class, 'destroy'])->name('series.destroy');