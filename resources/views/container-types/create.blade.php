@extends('layouts.form')

@section('form.title', 'тип контейнера')

@section('form.content')
    <form action="{{ route('container-type.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="name">Название</label>
            <x-form-control name="name" required autofocus />
        </div>

        <button class="btn btn-primary float-end" type="submit">Отправить</button>
    </form>
@endsection

@section('form.success-message')
    Тип контейнера успешно добавлен.
    <a class="fw-bold" href="{{ route('plants.create') }}"> Добавить растение.</a>
@endsection
