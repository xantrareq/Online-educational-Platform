<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar bg-body navbar-expand-sm bg-body-tertiary bg-dark border-bottom border-bottom-dark"
         data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('welcome_page')}}">
                <img src="http://localhost:8000/myassets/Frame2.svg" width="40" height="40" alt="логотип">
                Либра
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('course.main')}}">Список
                            курсов</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('course.my_courses')}}">Мои курсы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('course.ShowLiked')}}">Избранные курсы</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link">Отладка</a>
                    </li>

                </ul>
                {{--                    <form class="d-flex" role="search">--}}
                {{--                        <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">--}}
                {{--                        <button class="btn btn-outline-success" type="submit">Поиск</button>--}}
                {{--                    </form>--}}
                <div class="d-grid gap-2 d-md-block">
                    {{--                        <a class="btn btn-success" href="{{route('logging')}}" role="button">Вход</a>--}}
                    {{--                        <a class="btn btn-outline-success" href="{{route('register')}}" role="button">Регистрация</a>--}}
                </div>
                <link rel="stylesheet" href="{{asset('build\assets\app-D-sv12UV.css')}}">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @endguest

                        </li>

                </ul>


            </div>
        </div>
    </nav>
    <div class="container-fluid">
        @yield('content')
    </div>

</div>
</body>
</html>




