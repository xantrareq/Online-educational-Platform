@extends('layouts.main')
@section('content')
<div>

    <h3>Курсы</h3>
    <form class="gx-3 gy-2" action="{{route('course.store')}}" method="post">
        @csrf
        <div class="col col-sm-5">
            <label for="title" class="form-label">Название</label>
            <input type="text" name="title" class="form-control" id="title">
            <br>
        </div>
        <div class="col col-sm-5">
            <label for="descryption">Описание</label>
            <textarea name="descryption" class="form-control" id="descryption"></textarea>

            <br>
        </div>
        <div class="col col-sm-1">
            <label for="teacher_id" class="form-label">id учителя</label>
            <input type="text" name="teacher_id" class="form-control" id="teacher_id">
            <br>
        </div>
        <button type="submit" class="btn btn-success">Создать запись</button>
    </form>
</div>
@endsection
