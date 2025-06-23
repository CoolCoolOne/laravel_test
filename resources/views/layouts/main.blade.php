<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ларчик аутентефикация')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body class="bg-dark text-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">RoomNetO_2</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Главная</a>
                    </li>


                        @auth

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">Доска</a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}">Разлогиниться</a>
                            </li>



                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                            </li>
                        @endguest

                </ul>
                @auth
                <a class="text-decoration-none navbar-text bg-success rounded rounded-3 opacity-25" href="#">
                        <div class="nav-link text-dark">
                            <b>{{ auth()->user()->name }}</b>
                            @if (auth()->user()->hasVerifiedEmail())
                                <img class="rounded-pill" src="/images/avatars/{{ auth()->user()->avatar }}"
                                    alt="фото_профиля" width="50px">
                            @else
                                [не подтверждён]
                            @endif
                        </div>
                </a>
                @endauth
            </div>
        </div>
    </nav>







    <main class="main mt-3">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif



            @yield('content')
        </div>
    </main>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
