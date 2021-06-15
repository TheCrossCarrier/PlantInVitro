@extends('layouts.app')

@php $page_title_prefix = 'Добавить' @endphp

@section('title')
    {{ $page_title_prefix }} @yield('add.title')
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <h2 class="my-4">{{ $page_title_prefix }} @yield('add.title')</h2>

                {{-- @if ($errors->any())
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger fade show" role="alert">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif --}}
                @if (session('success'))
                    <x-alert type="success">
                        @yield('add.success-message')
                    </x-alert>
                @endif

                @yield('add.content')
            </div>
        </div>
    </div>
@endsection
