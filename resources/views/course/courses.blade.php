@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row ">

            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-10 col-md-10">
                <br>
                <h3>Курсы</h3>
                @php
                    use Illuminate\Support\Facades\Auth;
                    use App\Models\PageUser;

                    $userId = Auth::id();
                @endphp
                <br>
                <div>
                    {{$courses->withQueryString()->links()}}
                </div>

                <div class="d-flex justify-content-start">
                    <div class="w-100 p-2">
                        <input id="searchInput" class="form-control" type="search" placeholder="Поиск"
                               aria-label="Поиск">

                    </div>
                    <div class="p-2">
                        <button class="btn btn-outline-success" type="submit" onclick="redirectToSearch1()">Поиск
                        </button>
                    </div>
                    {{--                    <div class="col-sm-1 col-xs-1 col-md-1"></div>--}}
                    <div class="p-2 dropdown">
                        <button class="btn btn-outline-success dropdown-toggle" type="button"
                                id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Выберите теги
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="btn btn-success mt-2" type="button" onclick="redirectToSearch2()">Поиск
                            </button>
                            <div class="row">
                                @foreach ($tags->chunk(4) as $chunk)
                                    <div class="row">
                                        @foreach ($chunk as $tag)
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                           value="{{$tag->name}}" onclick="updateTags(event)"
                                                           id="tag1">
                                                    <label class="form-check-label"
                                                           for="tag1">{{$tag->name}}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                    {{--                    <div class="col-sm-1 col-xs-1 col-md-1"></div> <!-- Добавлено для отступа -->--}}
                    <div class="p-2">
                        <a class="btn btn-outline-success" href="/courses/list">Сбросить</a>
                    </div>
                </div>
                <br>
                <div class="d-flex justify-content-start">
                    <div class="w-10 p-2">
                        <input id="searchInputId" class="form-control me-1" type="search" placeholder="Поиск по id"
                               aria-label="Поиск по id">
                    </div>
                    <div class="p-2">
                        <button class="btn btn-outline-success" type="submit" onclick="redirectToSearch0()">Поиск
                        </button>
                    </div>
                </div>
                <br>
                <div>
                    <div class="row">
                        @foreach($courses as $course)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <div class="flex-fill align-items-center">
                                            <a href="{{route('course.show',$course->id)}}">
                                                <img src="http://localhost:8000/myassets/eye.svg" width="60" height="15"
                                                     alt="eye">
                                            </a>
                                        </div>
                                        <div class="flex-fill">
                                            @isset ($course->preview)
                                                @if ($course->preview != "" && Storage::exists('public/' . $course->preview))
                                                    <img class="img-fluid" style="width: auto; height: 60px;"
                                                         src="{{asset('/storage/' . $course->preview)}}" alt="">
                                                @else
                                                    <img src="http://localhost:8000/myassets/Frame3.svg" width="60"
                                                         height="60"
                                                         alt="eye">
                                                @endif
                                            @endisset
                                        </div>
                                        <div class="flex-fill">
                                            @php
                                                $userId = Auth::id();
                                                $liked = \App\Models\LikedCourse::where(['user_id'=>$userId,'course_id'=>$course->id])->first();
                                                $sum = 0;
                                                $result = 0;
                                            @endphp
                                            @if($liked !== null)
                                                <img src="http://localhost:8000/myassets/green_heart.svg" width="25"
                                                     height="25"
                                                     alt="like">
                                            @else
                                                <img src="http://localhost:8000/myassets/blue_heart.svg" width="25"
                                                     height="25"
                                                     alt="like">
                                            @endif
                                            <a>{{$course->likes}}</a>
                                        </div>
                                        <div class="col-9">
                                            <h5 class="card-title"><a>{{$course->title}}</a></h5>
                                            <p class="card-text">{{$course->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>

@endsection

<style>
    .pagination .page-item.active .page-link {
        background-color: darkseagreen;
        border-color: green;
        color: white;
    }

    .pagination .page-item .page-link {
        color: forestgreen;
    }

    .dropdown-menu {
        width: 400px; /* Автоматическая ширина */
    }

</style>


<script>
    function redirectToSearch0() {
        var searchQuery = document.getElementById('searchInputId').value;
        var url = "/courses/" + encodeURIComponent(searchQuery);
        window.location.href = url;
    }
</script>
<script>
    function redirectToSearch1() {
        var searchQuery = document.getElementById('searchInput').value;
        var url = "/courses/list?title=" + encodeURIComponent(searchQuery);
        window.location.href = url;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF"
        crossorigin="anonymous"></script>
<script>
    var selectedTags = [];

    function updateTags(event) {
        event.stopPropagation(); // Останавливаем всплытие события

        selectedTags = []; // Очищаем массив выбранных тегов
        var checkboxes = document.getElementsByClassName('form-check-input'); // Получаем все чекбоксы

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedTags.push(checkboxes[i].value); // Если чекбокс выбран, добавляем его значение в массив
            }
        }
    }

    function redirectToSearch2() {
        var url = "/courses/list?tags=" + encodeURIComponent(selectedTags.join(',')); // Преобразуем массив тегов в строку, разделенную запятыми
        window.location.href = url;
    }
</script>
