<x-layout title="Temporada de: {!! $series->nome  !!}">

    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-align-items-center">
            Temporada {{ $season->number }}

            <span class="badge bg-dark">
               {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>

</x-layout>
