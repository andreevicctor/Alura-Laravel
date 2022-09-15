<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;

class SeriesController extends Controller
{
    /**
     * Assim, agora estamos recebendo um repositório por parâmetro e salvando como uma propriedade da classe
     * O repositório é criado diretamente pelo Laravel pelo service container, e como temos essa propriedade 
     * já criada, podemos usar ela em todos os métodos.
     */
    public function __construct(private SeriesRepository $repository)
    {
    /**
     * Inversão de dependência. Ao invés de depender de algo concreto, dependemos de uma abstração, que é a 
     * interface de repositório SeriesRepository.
     * O que acontece agora é que esperamos algum repositório, pode ser usando o Eloquente, o PDO, MongoDB, 
     * em memória ou Doctrine, o que for. Para o SeriesController isso não importa, o que importa é que seja 
     * alguma classe que possua o método add, que receba os dados da requisição, $request, e de volta uma série 
     * criada, Series;, e é exatamente isso que temos em SeriesController.php na parte do código 
     * $serie = $this->repository->add($request);
     * O SeriesRepositoryProvider trata de ligar a interface SeriesRepository a implementação que queremos
     */
    }

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
        $serie = $this->repository->add($request);

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
