@extends('layouts.form')

@section('form.title', 'питательную среду')

@section('form.content')
    <form action="{{ route('medium.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="name">Название</label>
            <x-form-control name="name" required autofocus />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="short_name">Краткое название</label>
            <x-form-control name="short_name" required />
        </div>

        <button class="btn btn-primary float-end" type="submit">Отправить</button>
    </form>
@endsection

@section('form.success-message')
    Питательная среда успешно добавлена.
    <a class="fw-bold" href="{{ route('plants.create') }}"> Добавить растение.</a>
@endsection
