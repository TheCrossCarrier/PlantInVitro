@extends('layouts.form')

@section('form.title', 'Редактировать растение №' . $plant->id)

@section('form.content')
    <form action="{{ route('plants.update', $plant->id) }}" method="POST">
        @method('PUT')
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="name">Название</label>
            <x-form-control name="name" :value="$plant->name" required autofocus />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="description">Описание</label>
            <x-form-control name="description" type="textarea">{{ $plant->description }}</x-form-control>
        </div>

        <div class="d-flex align-items-center">
            <button class="order-1 btn btn-success ms-auto" type="submit">Сохранить</button>
            <a class="order-1 btn btn-secondary ms-2" href="{{ url()->previous() }}">Назад</a>
            <a class="link-info" href="">Редактировать контейнер</a>
        </div>
    </form>
@endsection

@section('form.success-message')
    Информация обновлена.
@endsection
