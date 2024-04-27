@extends('layouts.main')
@section('content')
<div>
    <h3>Курсы</h3>
    <a class="btn btn-success" href="{{route('course.create')}}" role="button">Создать курс</a>
    <div><br></div>
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
{{--                <th scope="row">{{$course->id}}</th>--}}
                <td href="{{route('course.show',$course->id)}}">{{$course->title}}</td>
{{--            <td>{{$course->descryption}}</td>--}}
                <td>{{$course->descryption}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@endsection
