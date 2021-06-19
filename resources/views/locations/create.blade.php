@extends('layouts.form')

@section('form.title', 'Добавить локацию')

@section('form.content')
    <form action="{{ route('locations.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="name">Название</label>
            <x-form-control name="name" required autofocus />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="description">Описание</label>
            <x-form-control name="description" type="textarea"></x-form-control>
        </div>

        <button class="btn btn-primary float-end" type="submit">Отправить</button>
    </form>
@endsection

@section('form.success-message')
    Локация успешно добавлена.
    <a class="fw-bold" href="{{ route('plants.create') }}"> Добавить растение.</a>
@endsection
