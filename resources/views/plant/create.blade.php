@extends('layouts.add')

@section('add.title', 'растение')

@section('add.content')
    @if ($container_types->isEmpty() || $media->isEmpty() || $taxa->isEmpty())
        <x-alert type="warning">Недостаточно данных для добавления растения, добавьте таксон/питательную среду.</x-alert>
    @endif

    <form action="{{ route('plant.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="name">Название</label>
            <x-form-control name="name" required autofocus />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="date_time">Дата и время</label>
            <x-form-control name="date_time" type="datetime-local" required />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="taxon_id">Таксон</label>
            <select class="form-select" id="taxon_id" name="taxon_id" required>
                @foreach ($taxa as $taxon)
                    <option value="{{ $taxon->id }}">{{ $taxon->subspecies ?? $taxon->species }}</option>
                @endforeach
            </select>
            <x-invalid-feedback name="taxon_id" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="container-type-id">Контейнер</label>
            <div class="input-group">
                <label class="input-group-text" for="container_type_id">Тип</label>
                <select class="form-select" id="container_type_id" name="container_type_id" required>
                    @foreach ($container_types as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <x-invalid-feedback name="container_type_id" />

                <label class="input-group-text" for="container_id">Номер</label>
                <x-form-control name="container_id" type="number" min="1" placeholder="Автоматически" />
            </div>
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="medium_id">Питательная среда</label>
            <select class="form-select" id="medium_id" name="medium_id" required>
                @foreach ($media as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-invalid-feedback name="medium_id" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="img">Фото</label>
            <x-form-control name="img" type="file" />
        </div>

        <button class="mb-3 btn btn-link link-info shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#location" aria-expanded="false" aria-controls="location">
            <i class="bi bi-plus-lg me-2"></i>
            Добавить локализацию
        </button>
        <div class="collapse mb-3 has-validation" id="location">
            <label class="form-label" for="location_id">Локализация</label>
            <select class="form-select" id="location_id" name="location_id">
                <option selected></option>
                @foreach ($locations as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <x-invalid-feedback name="location_id" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="description">Описание растения</label>
            <x-form-control name="description" type="textarea" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="comment">Комментарий</label>
            <x-form-control name="comment" type="textarea" />
        </div>

        <button class="btn btn-primary float-end" type="submit">Отправить</button>
    </form>
@endsection

@section('add.success-message')
    Растение успешно добавлено
    @if (session('plant_id'))
        <span> под номером {{ session('plant_id') }}.</span>
        @if (session('container_id'))
            <span> В контейнер под номером {{ session('container_id') }}.</span>
        @endif
        <a class="fw-bold" href="{{ route('plant.index', session('plant_id')) }}"> Перейти к растению.</a>
    @endif
@endsection
