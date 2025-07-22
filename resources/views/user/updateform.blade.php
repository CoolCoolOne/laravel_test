@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Редактировать профиль</h1>


            <form enctype="multipart/form-data" action="{{ route('update_userinfo_post') }}" method="post">

                @csrf


                <div class="mb-3">
                    <label for="name" class="form-label">Новый логин</label>
                    <input name='name' type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" placeholder="логин" value="{{ auth()->user()->name }}">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="avatar" class="form-label">Загрузите новый аватар [вместо <a style="color:white" href="/storage/images/avatars/{{ auth()->user()->avatar }}">старого</a>]</label>
                    <input name='avatar' value="{{ auth()->user()->avatar }}" 
                    class="form-control @error('avatar') is-invalid @enderror" 
                    type="file" id="avatar">

                    @error('avatar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Изменить данные!
                    </button>
                </div>


            </form>
        </div>
    </div>

@endsection
