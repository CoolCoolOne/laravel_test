@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Создание публикации</h1>


            <form action="{{ route('store.posts') }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input name='title' type="title" class="form-control @error('title') is-invalid @enderror"
                        id="title" placeholder="логин" value="{{ old('Заголовок') }}">

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Текст статьи</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <label for="exampleColorInput" class="form-label">Выбрать цвет!</label>
                <input type="color" class="form-control form-control-color" id="exampleColorInput" value="#563d7c"
                    title="Choose your color">




                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name='password' type="password" class="form-control" id="password" placeholder="пароль">
                </div>

                <div class="mb-3 form-check">
                    <input name="remember" class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">
                        Запомнить меня!
                    </label>
                </div>


                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Авторизация!
                    </button>
                    <a href="{{ route('password.request') }}" class="ms-3 text-secondary">Забыли пароль?</a>
                </div>



            </form>
        </div>
    </div>
@endsection
