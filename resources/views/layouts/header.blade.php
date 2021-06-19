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
                    <a class="nav-link @if ($active==='home' ) active" aria-current="page" @else " @endif
                        href=" {{ route('home') }}">Главная</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if ($active==='view' ) active" aria-current="page" @else " @endif
                        href=" {{ route('plants.index') }}">Просмотр</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @if ($active==='add' ) active" aria-current="page" @else " @endif
                        id="navbarAdd" href="#" data-bs-toggle="dropdown" aria-expanded="false">Добавить</a>

                    <ul class="dropdown-menu dropdown-menu-dark mb-3" aria-labelledby="navbarAdd">
                        <li>
                            <a class="dropdown-item" href="{{ route('plants.create') }}">Растение</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('taxa.create') }}">Таксон</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('media.create') }}">Питательную среду</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('locations.create') }}">Локацию</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('container-types.create') }}">Тип контейнера</a>
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
