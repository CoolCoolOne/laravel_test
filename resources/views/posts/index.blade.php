@extends('layouts.main')

@section('title')

@section('content')


    <div class="d-flex justify-content-around flex-wrap mt-5">

        @foreach ($posts as $post)

                <div class="card mb-4 bg-secondary" style="width: 12rem;">
                    {{-- <img src="storage/{{ $post->user->avatar }}" class="card-img-top rounded rounded-3" style="width: 100%; height:18rem" alt="ava_{{ $post->user->name }}"> --}}
                    <div class="card-body">
                        <h5 class="card-title" style="height: 10rem;">{{ $post->title }}</h5>
                        <hr>
                        <p class="card-text">Автор: 
                            <img src="storage/{{ $post->user->avatar }}" class="card-img-top rounded rounded-circle" style="width: 20%;" alt="ava_{{ $post->user->name }}">
                            <br>{{ $post->user->name }}
                        </p>
                    </div>
                    {{-- <ul class="list-group list-group-flush ">
                        <li class="list-group-item bg-secondary"><a class="text-info" href="#">Фотографии</a></li>
                        <li class="list-group-item bg-secondary"><a class="text-info" href="#">Публикации</a></li>
                        <li class="list-group-item bg-secondary"><a class="text-info" href="#">Чат</a></li>
                    </ul> --}}
                </div>

        @endforeach

    </div>
    {{ $posts->links('pagination::bootstrap-5') }} <!-- Пагинация -->



@endsection
