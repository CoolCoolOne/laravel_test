@extends('layouts.main')

@section('title')

@section('content')

    <div class="col-md-12 offset-md-12">
        <h1 class="mb-5">Ваш профиль</h1>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active alert-warning alert-link rounded" aria-current="page" href="{{route('update_userinfo')}}">Настройки профиля</a>
            </li>
            <li class="nav-item mt-4">
                <a class="nav-link active alert-success alert-link rounded" aria-current="page" href="{{route('posts.create')}}">Создать пост</a>
            </li>
            <li class="nav-item mt-2">
                <a class="nav-link active alert-success alert-link rounded" href="{{route('posts.manage')}}">Мои посты</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1">Загрузить фото</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1">Мои фото</a>
            </li>
        </ul>


    </div>
@endsection
