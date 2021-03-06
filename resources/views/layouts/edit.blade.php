@extends('layouts.app')

@section('edit.title') @yield('title') @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <h2 class="my-4">@yield('edit.title')</h2>

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
                        @yield('edit.success-message')
                    </x-alert>
                @endif

                @yield('edit.content')

            </div>
        </div>
    </div>
@endsection
