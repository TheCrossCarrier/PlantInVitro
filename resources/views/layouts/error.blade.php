@extends('layouts.app')

@section('title')
@yield('code') @yield('description')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-lg-9 col-xl-8 @if (empty($exception->getMessage())) mb-2 @endif">
                <h2 class="display-1 my-4">
                    @yield('code')
                    <span class="display-4">@yield('description')</span>
                </h2>

                @if (!empty($exception->getMessage()))
                    <div class="p-1 p-sm-3 text-muted">
                        <header class="d-flex align-items-center">
                            <h3 class="fw-normal">Текст ошибки</h3>
                            <button class="btn btn-secondary ms-auto">Скопировать</button>
                        </header>
                        <p class="p-2">
                            {{ $exception->getMessage() }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
