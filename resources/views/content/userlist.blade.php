@extends('layouts.main')

@section('title')

@section('content')


    <div class="d-flex justify-content-around flex-wrap mt-5">

        @foreach ($users->reverse() as $user)
            @if ($user->hasVerifiedEmail())
                <div class="card mb-4 bg-secondary" style="width: 10rem;">
                    <a href="storage/images/avatars/{{ $user->avatar }}"><img src="storage/images/avatars/comp/{{ $user->avatar }}" class="card-img-top rounded rounded-3" style="width: 100%; height:10rem" alt="ava_{{ $user->name }}"></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        {{-- <p class="card-text">Информация о себе</p> --}}
                    </div>
                    <ul class="list-group list-group-flush ">
                        {{-- <li class="list-group-item bg-secondary"><a class="text-info" href="#">Фотографии</a></li> --}}
                        <li class="list-group-item bg-secondary"><a class="text-info" href="{{route('all_posts_one_usr', $user->id)}}">Публикации</a></li>
                        {{-- <li class="list-group-item bg-secondary"><a class="text-info" href="#">Чат</a></li> --}}
                    </ul>
                </div>
            @endif
        @endforeach

    </div>
{{ $users->links('pagination::bootstrap-5') }}


@endsection
