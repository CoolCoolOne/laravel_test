@extends('layouts.main')

@section('title')

@section('content')
    <div class="row">
        <div class="col-md-12 offset-md-12">
            <h1 class="mb-5">Авторизация</h1>


            <form action="{{ route('user.store') }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email адрес</label>
                    <input name='email' type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="email" value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input name='password' type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="пароль">

                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input name="remember" class="form-check-input" type="checkbox" value="remember" id="remember">
                    <label class="form-check-label" for="remember">
                        Запомнить меня!
                    </label>
                </div>


                <div class="mt-5 text-center">
                    <button type="submit" class="btn  btn-light">
                        Авторизация!
                    </button>
                </div>


            </form>
        </div>
    </div>
@endsection
