@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Редактирование публикации</h1>


            <form action="{{ route('posts.update', $post) }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input name='title' type="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="Не более 100 символов" value="{{ $post->title }}">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Текст статьи</label>
                    <textarea name='content' class="form-control @error('content') is-invalid @enderror" id="content"
                        placeholder="Содержание" id="content" rows="5">{{ $post->content }}</textarea>


                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Изменить цвет!</label>
                    <input name='color' type="color" class="form-control form-control-color" id="color" value="{{ $post->color }}"
                        title="Выбрать цвет фона">
                </div>

                <div class="mb-3 form-check">
                    <input name="personal" class="form-check-input" type="checkbox" id="personal"
                        value="{{ $post->personal }}">
                    <label class="form-check-label" for="personal">
                        Скрытая (личная) публикация
                    </label>
                </div>


                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Опубликовать новую версию
                    </button>
                </div>



            </form>
        </div>
    </div>
@endsection
