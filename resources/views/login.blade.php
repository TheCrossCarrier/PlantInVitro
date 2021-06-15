@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="card col col-sm-11 col-md-9 col-lg-7 col-xl-6 needs-validation my-5 mx-2 p-0" action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <header class="card-header">
                    <h2 class="card-title fs-4">Вход</h2>
                </header>

                <div class="card-body py-4 px-2 px-sm-5">
                    <div class="mb-3 has-validation">
                        <label class="form-label" for="username">Имя пользователя</label>
                        <x-form-control name="username" required autofocus autocomplete />
                    </div>

                    <div class="mb-3 has-validation">
                        <label class="form-label" for="password">Пароль</label>
                        <x-form-control name="password" type="password" required autocomplete />
                    </div>

                    <div class="mb-3 fork-check">
                        <input class="form-check-input" id="remember_token" name="remember_token" type="checkbox" />
                        <label class="form-check-label" for="remember_token">Запомнить меня</label>
                    </div>

                    <div class="d-grid gap-2 py-2">
                        <button class="btn btn-primary" type="submit">Войти</button>
                        <a class="btn btn-info" href="{{ route('registration') }}">Регистрация</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
