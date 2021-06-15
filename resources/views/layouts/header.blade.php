<x-navbar class="header fixed-top" type="dark" expand="md" tag="header">
    <nav class="container-fluid">
        <h1 class="mb-0 fw-normal">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <span class="mx-2">
                    @include('svg.logo')
                </span>
                <span class="mx-2">Plant In Vitro</span>
            </a>
        </h1>

        <x-navbar-toggler target="#navList" aria-controls="navList" aria-expanded="false" title="Меню" />

        <x-navbar-collapse class="justify-content-between px-3" id="navList">
            <x-navbar-nav scroll>
                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName()==='home' ) active @endif" href="{{ route('home') }}"
                        aria-current="page">Главная</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if (Route::currentRouteName()==='view' ) active @endif" href="{{ route('view') }}">Просмотр</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link @if (preg_match('/^add/', Route::current()->uri)) active @endif dropdown-toggle" id="navbarAdd" href="#"
                        data-bs-toggle="dropdown" aria-expanded="false">Добавить</a>

                    <ul class="dropdown-menu dropdown-menu-dark mb-3" aria-labelledby="navbarAdd">
                        <li>
                            <a class="dropdown-item" href="{{ route('plant.create') }}">Растение</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('taxon.create') }}">Таксон</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('medium.create') }}">Питательную среду</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('location.create') }}">Локацию</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('container-type.create') }}">Тип контейнера</a>
                        </li>
                    </ul>
                </li>
            </x-navbar-nav>

            <div class="d-flex align-items-center justify-content-end">
                @guest
                    <a class="btn btn-primary text-light" href="{{ route('login') }}">Войти</a>
                    <a class="btn btn-info ms-3 text-light" href="{{ route('registration') }}">Регистрация</a>
                @endguest

                @auth
                    <span class="px-3 text-white">{{ Auth::user()->username }}</span>
                    <a class="btn btn-info text-light" href="{{ route('logout') }}">Выйти</a>
                @endauth
            </div>
        </x-navbar-collapse>
    </nav>
</x-navbar>
