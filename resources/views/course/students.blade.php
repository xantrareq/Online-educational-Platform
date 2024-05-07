@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            @php
                use App\Models\User;
            @endphp

            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-10 col-md-10">
                <br>
                <h3>Результаты</h3>
                <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>

                {{$userscourses->withQueryString()->links()}}
                <div>
                    <div class="row">

                        @foreach($userscourses as $course)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <div class="flex-fill align-items-center">
                                            @php

                                                $usrId = $course->user_id;
                                                $user = User::where('id',$usrId)->first();
                                                $name = $user->name;
                                            @endphp
                                            <a href="{{route('course.student.result',[$course,$usrId])}}">
                                                <img src="http://localhost:8000/myassets/eye.svg" width="60" height="15"
                                                     alt="eye">
                                            </a>
                                        </div>
                                        <div class="flex-fill">
                                            <p class="card-text">id {{$usrId}}</p>
                                        </div>
                                        <div class="flex-fill">
{{--                                            <h5 class="card-title"><a>{{$course->title}}</a></h5>--}}
                                            <p class="card-text">Имя {{$name}}</p>
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



