<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/x-icon" />

    <title>@yield('title') - {{ config('app.name', 'Plant In Vitro') }}</title>

    <script defer src="{{ asset('js/app.js') }}"></script>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>

<body class="antialiased bg-light">
    @include('layouts.header', ['active' => $navbar_active ?? null])

    <main class="main">
        @yield('content')
    </main>

    @include('layouts.footer')

    @if (Session::has('logged_in'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
            <div class="toast fade align-items-center text-white bg-primary" id="loggedInToast" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('logged_in') }}
                    </div>
                    <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Закрыть"></button>
                </div>
            </div>
        </div>
    @endif
</body>

</html>
