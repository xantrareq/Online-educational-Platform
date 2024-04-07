@extends('layouts.main')
@section('content')
<div>
    <h3>Курсы</h3>
    <div>
        <a class="btn btn-outline-success" href="{{route('course.main')}}" role="button">Назад</a>
        <a class="btn btn-success" href="{{route('course.edit',$course->id)}}" role="button">Изменить содержание</a>
        <br><br>
        <form action="{{route('course.destroy',$course->id)}}" method="post">
            @csrf
            @method('delete')
            <input class="btn btn-outline-danger" value="Удалить пост" type="submit"></input>
        </form>
    </div>
    <br>
    <div>
        <h5>Курс "{{$course->title}}"</h5>
        <div>id учителя: {{$course->id}}</div>
        <div>
            {!! nl2br($course->descryption) !!}
        </div>
    </div>
</div>
@endsection
