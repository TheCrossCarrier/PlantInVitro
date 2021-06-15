@extends('layouts.app')

@section('title', $plant->name)

@section('content')
    <section class="container">
        <main class="row flex-column align-items-start my-3">
            <div class="col row flex-column flex-md-row align-items-center align-items-md-start m-0 p-0">
                {{-- Левая часть --}}
                <div class="col col-md-6 col-lg-5 col-xl-4 row flex-column">
                    {{-- Название и Фото --}}
                    <figure class="col card p-0 shadow">
                        <figcaption class="card-header">
                            <h2 class="card-title text-center">{{ $plant->name }}</h2>
                        </figcaption>
                        <img class="card-img-bottom object-fit-cover" style="object-position: center"
                            src="{{ $img_path ?? asset('img\database\default_plant.svg') }}" width="400" height="404"
                            alt="{{ $plant->name }}" />
                    </figure>

                    {{-- Информация --}}
                    <footer class="col container p-0">
                        {{-- Статус --}}
                        <div class="input-group row ms-0">
                            <label class="col-7 input-group-text" for="status">Статус</label>
                            <x-form-control
                                class="col bg-{{ $plant->death ? 'danger' : 'success' }} text-light text-center" readonly
                                name="status" :value="$plant->death ? 'Погиб' : 'В работе'" />
                        </div>

                        {{-- Родитель --}}
                        <a class="input-group row ms-0 mt-2 text-decoration-none" @if ($plant->parent) href="{{ route('plant.index', $plant->parent->id) }}" @endif>
                            <label class="col-7 input-group-text" for="parent">Родитель</label>

                            <x-form-control
                                class="col text-center text-truncate {{ $plant->parent ? 'text-decoration-underline text-decoration-thickness-light' : '' }} cursor-pointer"
                                readonly name="parent" value="{{ $plant->parent->name ?? '--/--' }}" />
                        </a>
                        {{-- Последнее действие --}}
                        <div class="input-group row ms-0 mt-2">
                            <label class="col-7 input-group-text" for="last_action_date">Последнее действие</label>
                            <x-form-control class="col text-center" readonly name="last_action_date"
                                :value="(new DateTime($actions->last()->date))->format('d.m.y G:i')" />
                        </div>
                        {{-- Последнее редактирование --}}
                        <div class="input-group row ms-0 mt-2">
                            <label class="col-7 input-group-text" for="last_edit_date">Последнее редактирование</label>
                            <x-form-control class="col text-center" readonly name="last_edit_date"
                                :value="(new DateTime($plant->updated_at))->format('d.m.y G:i')" />
                        </div>
                    </footer>
                </div>

                {{-- Правая часть --}}
                <div class="col col-md-6 col-lg-7 col-xl-8 m-0 ms-md-3 p-0 py-1">
                    {{-- Панель управления --}}
                    <div>
                        <div class="d-flex justify-content-center justify-content-sm-end align-items-center px-2">
                            <a class="btn btn-success @if ($plant->death) disabled @endif d-flex align-items-center bg-transparent border-0 p-2 lh-1 text-success"
                                href="{{ route('plant.transplant', $plant->id) }}">
                                <i class="bi bi-reply-fill fs-4 me-2"></i>
                                Пересадить
                            </a>

                            <a class="btn btn-info @if ($plant->death) disabled @endif d-flex align-items-center bg-transparent border-0 ms-0 ms-lg-2 p-2 lh-1
                                text-info"
                                href="{{ route('plant.edit', $plant->id) }}">
                                <i class="bi bi-pencil-fill fs-5 me-2"></i>
                                Редактировать
                            </a>

                            <a class="btn btn-danger @if ($plant->death) disabled @endif d-flex align-items-center bg-transparent border-0 ms-0 ms-lg-2 p-2 lh-1
                                text-danger"
                                href="{{ route('plant.died', $plant->id) }}">
                                <i class="bi bi-x-lg fs-5 me-2"></i>
                                Погибло
                            </a>

                        </div>

                        <hr class="mt-1" />
                    </div>

                    {{-- Описание --}}
                    <article class="card mb-3 shadow">
                        <header class="card-header">
                            <h3 class="card-title ms-3 fs-4">Описание</h3>
                        </header>
                        <main class="card-body">
                            <p class="card-text lead">
                                <span class="ms-4">{{ $plant->description ?? '--/--' }}</span>
                            </p>
                        </main>
                    </article>

                    {{-- Номер & Локализация --}}
                    <div class="row flex-column flex-xl-row m-0 p-0">
                        {{-- Номер --}}
                        <article class="card col mb-3 p-0 shadow">
                            <header class="card-header">
                                <h3 class="card-title fs-4 text-center">Номер</h3>
                            </header>
                            <main class="card-body">
                                <p class="card-text text-center fs-5">{{ $plant->id }}</p>
                            </main>
                        </article>

                        {{-- Локализация --}}
                        <article class="card col mb-3 ms-xl-3 p-0 shadow">
                            <header class="card-header">
                                <h3 class="card-title fs-4 text-center">Локализация</h3>
                            </header>
                            <main class="card-body">
                                <p class="card-text text-center">
                                    @if ($last_relocation)
                                        <a class="link-dark text-decoration-thickness-light" href="">
                                            {{ $last_relocation->location_name }}
                                        </a>
                                    @else --/--
                                    @endif
                                </p>
                            </main>
                        </article>
                    </div>

                    {{-- Таксономия & Контейнер --}}
                    <div class="row flex-column flex-xl-row m-0 p-0">
                        {{-- Таксономия --}}
                        <article class="card col mb-3 p-0 shadow">
                            <header class="card-header">
                                <h3 class="card-title fs-4 text-center">Таксономия</h3>
                            </header>

                            <ul class="list-group list-group-flush border-bottom">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Семейство: </div>
                                        <div class="col">
                                            <i>
                                                @if ($plant->taxon->family)
                                                    <a class="link-dark text-decoration-thickness-light"
                                                        href="">{{ $plant->taxon->family }}</a>
                                                @else --/--
                                                @endif
                                            </i>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Род: </div>
                                        <div class="col">
                                            <i>
                                                @if ($plant->taxon->genus)
                                                    <a class="link-dark text-decoration-thickness-light"
                                                        href="">{{ $plant->taxon->genus }}</a>
                                                @else --/--
                                                @endif
                                            </i>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Вид: </div>
                                        <div class="col">
                                            <i>
                                                @if ($plant->taxon->species)
                                                    <a class="link-dark text-decoration-thickness-light"
                                                        href="">{{ $plant->taxon->species }}</a>
                                                @else --/--
                                                @endif
                                            </i>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Подвид: </div>
                                        <div class="col">
                                            <i>
                                                @if ($plant->taxon->subspecies)
                                                    <a class="link-dark text-decoration-thickness-light"
                                                        href="">{{ $plant->taxon->subspecies }}</a>
                                                @else --/--
                                                @endif
                                            </i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </article>

                        {{-- Контейнер --}}
                        <article class="card col mb-3 ms-xl-3 p-0 shadow">
                            <header class="card-header">
                                <h3 class="card-title fs-4 text-center">Контейнер</h3>
                            </header>
                            <ul class="list-group list-group-flush border-bottom">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Номер: </div>
                                        <div class="col">
                                            <a class="link-dark text-decoration-thickness-light" href="">
                                                {{ $last_container->id }}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Тип: </div>
                                        <div class="col">
                                            <a class="link-dark text-decoration-thickness-light" href="">
                                                {{ $last_container->type->name }}
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-5 text-end">Среда: </div>
                                        <div class="col">
                                            @if ($last_container->medium)
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    {{ $last_container->medium->short_name }}
                                                </a>
                                            @else --/--
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </article>
                    </div>

                    <hr class="my-0" />

                    <h3 class="mt-1 mx-3 py-1">Действия</h3>

                    <hr class="mt-0" />

                    {{-- Действия --}}
                    @foreach ($actions->reverse() as $action)
                        <article class="card mb-3 shadow">
                            <header class="card-header d-flex position-relative">
                                <h3 class="card-title ms-3 fs-4">{{ $action->action_name }}</h3>
                                <span class="ms-auto position-absolute me-4 end-0 top-50 translate-middle-y">
                                    @datetime($action->date)
                                </span>
                            </header>
                            <main class="card-body">
                                <div class="card-text ps-4">
                                    <p class="lead mb-0 lh-lg">
                                        @switch($action->type_id) {{-- ActionTypeSeeder::$types --}}
                                            {{-- Посадка --}}
                                            @case(1)
                                                <b>Таксон: </b>
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    <i>{{ $plant->taxon->subspecies ?? $plant->taxon->species }}</i>
                                                </a>
                                                <br />

                                                @php $container = $Container::find($action->container_id) @endphp
                                                <b>Контейнер: </b>
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    {{ $container->type->name }}
                                                    №{{ $container->id }}
                                                </a>
                                                <br />

                                                <b>Среда: </b>
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    {{ $container->medium->name }}
                                                </a>
                                            @break

                                            {{-- Гибель --}}
                                            @case(2)
                                                <b>Причина: </b>
                                                {{ $action->cause }}
                                            @break

                                            {{-- Подпитка --}}
                                            @case(3)
                                            @break

                                            {{-- Релокация --}}
                                            @case(4)
                                                <b>Новая локация: </b>
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    {{ $action->location_name }}
                                                </a>
                                            @break

                                            {{-- Пересадка --}}
                                            @case(5)
                                                @php $container = $Container::find($action->container_id) @endphp
                                                <b>Тип контейнера: </b>
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    {{ $container->type->name }}
                                                </a>
                                                <br />
                                                <b>Номер контейнера: </b>
                                                <a class="link-dark text-decoration-thickness-light" href="">
                                                    {{ $container->id }}
                                                </a>
                                            @break
                                        @endswitch

                                        @if ($action->comment)
                                            <br />
                                            <b>Комментарий: </b>
                                            {{ $action->comment }}
                                        @endif
                                    </p>
                                </div>

                            </main>
                            <footer class="card-footer d-flex">
                                <div>Пользователь <b>{{ $action->username }}</b></div>
                                <div class="ms-auto">Создано @datetime($action->created_at)</div>
                                {{-- @if ($action->created_at !== $action->updated_at)
                                    <div>Обновлено @datetime($action->updated_at)</div>
                                @endif --}}
                            </footer>
                        </article>
                    @endforeach
                </div>
        </main>
    </section>
@endsection
