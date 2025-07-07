@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Создание публикации</h1>


            <form action="{{ route('posts.store') }}" method="post">

                @csrf

                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input name='title' type="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="Не более 100 символов" value="{{ old('title') }}">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Текст статьи (>50 символов)</label>
                    <textarea name='content' class="form-control @error('content') is-invalid @enderror" id="content"
                        placeholder="Содержание" id="content" rows="5">{{ old('content') }}</textarea>


                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3" >
                    <label for="color" class="form-label">Выбрать цвет!</label>
                    <input type="color" class="form-control form-control-color" id="color" value="#6C757D"
                        title="Выбрать цвет фона">
                </div>

                <div class="mb-3 form-check">
                    <input name="personal" class="form-check-input" type="checkbox" id="personal">
                    <label class="form-check-label" for="personal">
                        Скрытая (личная) публикация
                    </label>
                </div>


                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Опубликовать
                    </button>
                </div>



            </form>
        </div>
    </div>
@endsection



