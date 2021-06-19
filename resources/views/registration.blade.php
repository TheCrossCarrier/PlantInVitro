@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="card col col-sm-11 col-md-9 col-lg-7 col-xl-6 needs-validation my-4 my-sm-5 mx-0 mx-sm-2 p-0"
                action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                <header class="card-header">
                    <h2 class="card-title fs-4">Регистрация</h2>
                </header>

                <div class="card-body py-4 px-2 px-sm-5">

                    @if (Session::has('success'))
                        <x-alert type="success">
                            {{ session('success') }}
                            Теперь Вы можете <a class="alert-link" href="{{ route('login') }}">Войти</a>
                        </x-alert>
                    @endif

                    <div class="mb-3 has-validation">
                        <label class="form-label" for="username">Имя пользователя</label>
                        <x-form-control name="username" required autofocus />
                    </div>

                    <div class="mb-3 has-validation">
                        <label class="form-label" for="password">Пароль</label>
                        <x-form-control name="password" type="password" required />
                    </div>

                    <div class="mb-3 has-validation">
                        <label class="form-label" for="password_confirmation">Повторите пароль</label>
                        <x-form-control name="password_confirmation" type="password" required />
                    </div>

                    <div class="d-grid py-2">
                        <button class="btn btn-info" type="submit">Регистрация</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
