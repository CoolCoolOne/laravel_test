@extends('layouts.main')

@section('title')

@section('content')



    <div class=" mt-5 rounded p-2" style="background-color: {{$post->color}}">



                        <h5 class="card-title" >{{ $post->title }}</h5>
                        <br>

                        <div>
                             <img src="/storage/images/post_logos/{{ $post->logo }}" class="rounded" style="width: 40vh; float:left; margin: 5px 10px 5px 0;" alt="ava_{{ $post->user->name }}">
                            {!! nl2br($post->content) !!}
                        
                        </div>

                        <br>
                        <hr>
                        <p class="card-text">Автор:    
                            <img src="/storage/images/avatars/{{ $post->user->avatar }}" class="rounded rounded-circle" style="width: 5%;" alt="ava_{{ $post->user->name }}">
                            {{ $post->user->name }}
                        </p>


    </div>

    



@endsection
