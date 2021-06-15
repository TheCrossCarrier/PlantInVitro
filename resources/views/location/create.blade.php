@extends('layouts.add')

@section('add.title', 'локацию')

@section('add.content')
    <form action="{{ route('location.store') }}" method="POST" novalidate>
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

@section('add.success-message')
    Локация успешно добавлена.
    <a class="fw-bold" href="{{ route('plant.create') }}"> Добавить растение.</a>
@endsection
