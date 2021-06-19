@extends('layouts.form')

@section('form.title', 'таксон')

@section('form.content')
    {{-- @if ($errors->any())
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </li>
            @endforeach
        </ul>
    @endif --}}

    <form action="{{ route('taxon.store') }}" method="POST">
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="family">Семейство</label>
            <x-form-control name="family" autofocus />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="genus">Род</label>
            <x-form-control name="genus" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="species">Вид</label>
            <x-form-control name="species" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="subspecies">Подвид</label>
            <x-form-control name="subspecies" />
        </div>

        <button class="btn btn-primary float-end" type="submit">Отправить</button>
    </form>
@endsection

@section('form.success-message')
    Таксон успешно добавлен.
    <a class="fw-bold" href="{{ route('plants.create') }}"> Добавить растение.</a>
@endsection
