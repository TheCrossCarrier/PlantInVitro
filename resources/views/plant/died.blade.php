@extends('layouts.edit')

@php $title = "Гибель растения №$id" @endphp
@section('edit.title', $title)

@section('edit.content')
    <form action="{{ route('plant.store-death', $id) }}" method="POST" novalidate>
        @csrf

        <div class="mb-3 has-validation">
            <label class="form-label" for="date_time">Дата и время</label>
            <x-form-control name="date_time" type="datetime-local" required />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="cause_id">Причина</label>
            <select class="form-select" id="cause_id" name="cause_id">
                <option selected></option>
                @foreach ($causes as $cause_id => $cause_name)
                    <option value="{{ $cause_id }}">{{ $cause_name }}</option>
                @endforeach
            </select>
            <x-invalid-feedback name="cause_id" />
        </div>

        <div class="mb-3 has-validation">
            <label class="form-label" for="comment">Комментарий</label>
            <x-form-control name="comment" type="textarea"></x-form-control>
        </div>

        <div class="d-flex align-items-center">
            <button class="btn btn-success ms-auto" type="submit">Сохранить</button>
            <a class="btn btn-secondary ms-2" href="{{ url()->previous() }}">Назад</a>
        </div>
    </form>
@endsection

@section('edit.success-message')
    Данные сохранены.
@endsection
