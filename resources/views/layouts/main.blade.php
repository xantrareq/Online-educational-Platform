<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="http://localhost:8000/myassets/Frame.svg" type="image/svg">
    <link rel="stylesheet" href ="{{asset('build\assets\app-D-sv12UV.css')}}">
    <title>
        Libra
    </title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="navbar bg-body navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('welcome_page')}}">
                    <img src="http://localhost:8000/myassets/Frame2.svg" width="40" height="40"  alt="логотип">
                    Либра
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('course.main')}}">Список курсов</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link disabled">Настройки</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link">Отладка</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                    </form>

{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                            <img src="http://localhost:8000/myassets/man.svg" width="35" height="35"  alt="логотип">--}}
{{--                            Профиль--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a class="dropdown-item" href="#">Action</a></li>--}}
{{--                            <li><a class="dropdown-item" href="#">Another action</a></li>--}}
{{--                            <li><hr class="dropdown-divider"></li>--}}
{{--                            <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <!-- Группы больших кнопок (по умолчанию и разделенные) -->
                    <!-- Кнопка выпадающего списка вправо по умолчанию -->

                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('my_profile.main')}}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="http://localhost:8000/myassets/man.svg" width="35" height="35"  alt="логотип">
                                Профиль
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @yield('content')
</div>
</body>
</html>
