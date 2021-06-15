@extends('layouts.app')

@section('title', 'Просмотр')

@section('content')
    <div class="container-fluid pb-2">
        <header class="d-flex align-items-center">
            {{-- Заголовок --}}
            <h2 class="py-2 display-5">Растения</h2>

            {{-- Поиск --}}
            <form class="ms-5" action="#" method="GET" novalidate>
                <div class="input-group shadow-sm">
                    <x-form-control name="search" placeholder="Искать.." type="search" required />
                    <button class="btn btn-warning" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Категории --}}
            <div class="ms-auto btn-group shadow-sm" role="toolbar">
                <a class="btn btn-primary active" href="">Растения</a>
                <a class="btn btn-primary" href="">Контейнеры</a>
                <div class="btn-group" role="group">
                    <button class="btn btn-primary dropdown-toggle" id="taxonDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">Таксоны</button>

                    <ul class="dropdown-menu" aria-labelledby="taxonDropdown">
                        <li><a class="dropdown-item" href="">Семейства</a></li>
                        <li><a class="dropdown-item" href="">Роды</a></li>
                        <li><a class="dropdown-item" href="">Виды</a></li>
                        <li><a class="dropdown-item" href="">Подвиды</a></li>
                    </ul>
                </div>
                <a class="btn btn-primary" href="">Локации</a>
                <a class="btn btn-primary" href="">Типы контейнера</a>
                <a class="btn btn-primary" href="">Питательные среды</a>
            </div>
        </header>

        <hr class="mt-0" />

        {{-- Контент --}}
        <main class="list-group text-center shadow">
            <header class="list-group-item d-flex bg-dark text-white">
                <div class="col-1">#</div>
                <div class="col-1">Номер</div>
                <div class="col-2">Название</div>
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
                <a class="list-group-item list-group-item-action d-flex" href="{{ route('plant.index', $plant->id) }}">
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

        {{-- Пагинация --}}
        <footer class="container mt-3">
            <nav class="d-flex justify-content-center align-items-center">
                <ul class="pagination mb-0 shadow-sm">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Пред</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">След</a>
                    </li>
                </ul>
            </nav>
        </footer>
    </div>
@endsection
