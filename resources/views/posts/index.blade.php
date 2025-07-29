@extends('layouts.main')

@section('title')

@section('content')



    <div class="d-flex justify-content-around flex-wrap mt-5">

        @foreach ($posts as $post)
            <a href="{{ route('one_post', $post) }}" style="text-decoration: none">
                <div class="card mb-4 bg-secondary" style="width: 10rem;">

                    <div class="card-body" style="background-color: {{ $post->color }}">
                        <h5 class="card-title text-white" style="height: 5rem;">{{ $post->title }}</h5>



                        @if (is_null($post->logo))
                            <img src="/storage/images/avatars/comp/{{ $post->user->avatar }}" class="card-img-top"
                                alt="logo_{{ $post->logo }}" style="height: 7rem; object-fit: cover;">
                        @else
                            <img src="/storage/images/post_logos/comp/{{ $post->logo }}" class="card-img-top"
                                alt="logo_{{ $post->logo }}" style="height: 7rem; object-fit: cover;">
                        @endif

                        <hr>
                        <p class="card-text text-white">Автор:
                            <img src="/storage/images/avatars/comp/{{ $post->user->avatar }}"
                                class="card-img-top rounded rounded-circle" style="width: 20%;"
                                alt="{{ $post->user->name }}">
                            <br class="text-white">{{ $post->user->name }}
                        </p>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
    {{ $posts->links('pagination::bootstrap-5') }} <!-- Пагинация -->




@endsection
