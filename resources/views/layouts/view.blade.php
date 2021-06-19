@extends('layouts.app')

@section('title', 'Просмотр')

@php $navbar_active ='view' @endphp

@section('content')
    <div class="container-fluid pb-2">
        <header class="d-flex align-items-center">
            <h2 class="py-2 display-5">@yield('title')</h2>

            {{-- Search --}}
            <form class="ms-5" action="#" method="GET" novalidate>
                <div class="input-group shadow-sm">
                    <x-form-control name="search" placeholder="Искать.." type="search" required />
                    <button class="btn btn-warning" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            {{-- Categories --}}
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

        @yield('view.content')

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
