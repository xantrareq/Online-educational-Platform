@extends('layouts.main')
@section('content')
<div>

    <h3>Изменить урок "{{$page->name}}" Курса "{{$course->title}}"</h3>
    <a class="btn btn-outline-success" href="{{route('course_page.show',[$course->id,$page->id])}}" role="button">Назад</a>

    <form class="gx-3 gy-2" action="{{route('page.update', ['course' => $course->id,$page->id])}} " method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="col col-sm-5">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" class="form-control" id="name" value="{{$page->name}}">
            <br>
        </div>
        @error('name')
        <p class="text-danger">Введите название</p>
        @enderror
        <div class="col col-sm-5">
            <label for="text">Текст</label>
            <textarea name="text" class="form-control" id="text" >{{$page->text}}</textarea>
            <br>
        </div>
        @error('text')
        <p class="text-danger">Введите текст</p>
        @enderror
        <div class="col col-sm-5">
            <label for="homework_condition">Домашнее задание</label>
            <textarea name="homework_condition" class="form-control" id="homework_condition">{{$page->homework_condition}}</textarea>
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="answer" class="form-label">Ответ на домашнее задание</label>
            <input type="text" name="answer" class="form-control" id="answer" value="{{$page->answer}}">
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="youtube_link" class="form-label">Ссылка</label>
            <input type="text" name="youtube_link" class="form-control" id="youtube_link" value="{{$page->youtube_link}}">
            <br>
        </div>
        <div>
            <div class="form-group">
                <input type="file" name="image">
            </div>
        </div>
        <br>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" name="check_delete_photo" id="check_delete_photo">
            <label class="form-check-label" for="flexCheckDefault">
                Удалить фото
            </label>
        </div>
        <button type="submit" class="btn btn-success">Изменить урок</button>
    </form>
</div>
@endsection
