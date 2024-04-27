@extends('layouts.main')
@section('content')
<div>

    <h3>Добавить страницу курсу {{$course->title}}</h3>
    <form class="gx-3 gy-2" action="{{route('page.store', ['course' => $course->id])}} " method="post" enctype="multipart/form-data">>
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
        <div>
            <div class="form-group">
                <input type="file" name="image">
            </div>
        </div>

        <button type="submit" class="btn btn-success">Создать запись</button>
    </form>
</div>
@endsection
