@extends('layouts.view')

@section('title', 'Растения')

@section('view.content')
    <main class="list-group text-center shadow">
        <header class="list-group-item d-flex bg-dark text-white">
            <div class="col-1">#</div>
            <div class="col-1">Номер</div>
            <div class="col-2">Коллекционное имя</div>
            <div class="col-2">Таксон</div>
            <div class="col-2">Описание</div>
            <div class="col-2">Расположение</div>
            <div class="col-2">Последнее действие</div>
        </header>

        @foreach ($plants->reverse() as $plant)
            @php
                $last_container = $Container::find($plant->containers->last()->id);
                $last_action = collect([$plant->plantings->last(), $plant->death, $last_container->relocations->last(), $last_container->nutrition->last()])
                    ->sortBy('date')
                    ->last();
            @endphp

            <a class="list-group-item list-group-item-action d-flex" href="{{ route('plants.show', $plant->id) }}">
                <div class="col-1 px-1">{{ $loop->iteration }}</div>
                <div class="col-1 px-1">{{ $plant->id }}</div>
                <div class="col-2 px-1 text-nowrap text-truncate">{{ $plant->name }}</div>
                <div class="col-2 px-1 text-nowrap text-truncate">
                    {{ $plant->taxon->subspecies ?? $plant->taxon->species }}
                </div>
                <div class="col-2 px-1 text-nowrap text-truncate">{{ $plant->description ?? '--/--' }}</div>
                <div class="col-2 px-1 text-nowrap text-truncate">
                    {{ $last_container->type->name }}
                    №{{ $last_container->id }},
                    {{ $last_container->relocations->last()->location_name ?? '--/--' }}
                </div>

                <div class="col-2 px-1 text-nowrap text-truncate">
                    @datetime($last_action->date)
                    {{ $last_action->action_name }}
                </div>
            </a>
        @endforeach
    </main>
@endsection
