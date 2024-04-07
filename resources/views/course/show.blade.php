@extends('layouts.main')
@section('content')
<div>
    <h3>Курсы</h3>
    <a class="btn btn-success" href="{{route('course.main')}}" role="button">Назад</a>
    <br><br>
    <h5>Курс "{{$course->title}}"</h5>
    <div>id: {{$course->id}}</div>
    <div>{{$course->content}}</div>
</div>
@endsection
