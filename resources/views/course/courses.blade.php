@extends('layouts.main')
@section('content')
<div>
    <h3>Курсы</h3>
    @php
        use Illuminate\Support\Facades\Auth;
        $userId = Auth::id();
    @endphp

    @if($userId)
        <a class="btn btn-success" href="{{route('course.create')}}" role="button">Создать курс</a>
    @else
        <span>Авторизуйтесь, чтобы создавать курсы.</span>
    @endif

    <div><br></div>
    <div>

        <style>
            .pagination .page-item.active .page-link {
                background-color: darkseagreen;
                border-color: green;
                color: white;
            }
            .pagination .page-item .page-link {
                color: forestgreen;
            }
        </style>
        <div>
            {{$courses->withQueryString()->links()}}
        </div>
        <div class="row sm-1">

        </div>
        <div class="row" >
            <div  class="col-md-5 d-flex align-items-center">
                <input id="searchInput" class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                <button class="btn btn-outline-success" type="submit" onclick="redirectToSearch1()">Поиск</button>

                <script>
                    function redirectToSearch1() {
                        var searchQuery = document.getElementById('searchInput').value;
                        var url = "/courses/list?title=" + encodeURIComponent(searchQuery);
                        window.location.href = url;
                    }
                </script>



                <div style="margin: 11px" class="dropdown">
                    <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Выберите теги
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button class="btn btn-success mt-2" type="button" onclick="redirectToSearch2()">Поиск</button>
                        <div class="container-fluid">
                            @foreach ($tags->chunk(4) as $chunk)
                                <div class="row">
                                    @foreach ($chunk as $tag)
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{$tag->name}}" onclick="updateTags(event)" id="tag1">
                                                <label class="form-check-label" for="tag1">{{$tag->name}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>









                <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
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


            </div>
        </div>
        <br>

    </div>
    <table class="table">
        <thead class = "table-success">
        <tr>
            <th class="col-1"> </th>
{{--            <th>#</th>--}}
            <th>Название курса</th>
{{--            <th>Описание курса</th>--}}
{{--            <th>Id учителя</th>--}}
            <th>Описание</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <th><a href="{{route('course.show',$course->id)}}"><img src="http://localhost:8000/myassets/eye.svg" width="60" height="15" alt="eye"></a></th>

                <td href="{{route('course.show',$course->id)}}">{{$course->title}}</td>

                <td>{{$course->description}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>


</div>
@endsection
