@extends('layouts.main')

@section('title')

@section('content')



    <div class=" mt-5 rounded p-2" style="background-color: {{$post->color}}">



                        <h5 class="card-title" >{{ $post->title }}</h5>
                        <p>
                            {{$post->color}}
                        </p>
                        <p class="card-text">Автор: 
                            <img src="storage/{{ $post->user->avatar }}" class="card-img-top rounded rounded-circle" style="width: 20%;" alt="ava_{{ $post->user->name }}">
                            {{ $post->user->name }}
                        </p>

                        <div>{{ $post->content }}</div>


    </div>

    



@endsection
