@extends('layouts.main')

@section('title')

@section('content')



    <div class=" mt-5 rounded p-2" style="background-color: {{ $post->color }}">



        <h5 class="card-title"  style="text-align: center;">{{ $post->title }}</h5>
        <br>

        <div>
            @if (is_null($post->logo))
            @else
                <img src="/storage/images/post_logos/{{ $post->logo }}" class="rounded"
                    style="width: 40vh; display: block; margin: 0 auto;" alt="logo_{{ $post->logo }}"><br>
            @endif        
                {!! nl2br($post->content) !!}

        </div>

        <br>
        <hr>
        <p class="card-text">Автор:
            <img src="/storage/images/avatars/comp/{{ $post->user->avatar }}" class="rounded rounded-circle"
                style="width: 5%;" alt="ava_{{ $post->user->name }}">
            {{ $post->user->name }}
        </p>


    </div>





@endsection
