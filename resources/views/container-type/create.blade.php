@extends('layouts.add')

@section('add.title', 'тип контейнера')

@section('add.content')
    <form action="{{ route('container-type.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="name">Название</label>
            <x-form-control name="name" required autofocus />
        </div>

        <button class="btn btn-primary float-end" type="submit">Отправить</button>
    </form>
@endsection

@section('add.success-message')
    Тип контейнера успешно добавлен.
    <a class="fw-bold" href="{{ route('plant.create') }}"> Добавить растение.</a>
@endsection
