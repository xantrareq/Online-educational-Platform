@extends('layouts.main')
@section('content')
<div>

    <h3>Добавить страницу курсу {{$course->title}}</h3>
    <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>

    <form class="gx-3 gy-2" action="{{route('page.store', ['course' => $course->id])}} " method="post" enctype="multipart/form-data">
        @csrf
        <div class="col col-sm-5">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" class="form-control" id="name">
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="text">Текст</label>
            <textarea name="text" class="form-control" id="text"></textarea>
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="homework_condition">Домашнее задание</label>
            <textarea name="homework_condition" class="form-control" id="homework_condition"></textarea>
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="answer" class="form-label">Ответ на домашнее задание</label>
            <input type="text" name="answer" class="form-control" id="answer">
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="youtube_link" class="form-label">Ссылка</label>
            <input type="text" name="youtube_link" class="form-control" id="youtube_link">
            <br>
        </div>
        <div>
            <div class="form-group">
                <input type="file" name="image">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Создать урок</button>
    </form>
</div>
@endsection
