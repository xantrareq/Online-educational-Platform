@extends('layouts.main')
@section('content')
<div>
    <h3>Изменить содержание курса "{{$course->title}}"</h3>
    <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>

    <form class="gx-3 gy-2" action="{{route('course.update',$course->id)}}" method="post">
        @csrf
        @method('patch')
        <div class="col col-sm-5">
            <label for="title" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="title" value="{{$course->title}}">
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="descryption">Описание</label>
            <textarea name="descryption" class="form-control" id="descryption" >{{$course->descryption}}</textarea>

            <br>
        </div>
        <div class="col col-sm-1">
            <label for="teacher_id" class="form-label">id учителя</label>
            <input type="text" name="teacher_id" class="form-control" id="teacher_id" value="{{$course->teacher_id}}">
            <br>
        </div>
        <button type="submit" class="btn btn-success">Изменить запись</button>
    </form>
</div>
@endsection
