@extends('layouts.main')
@section('content')
    <div>
        <div>
            <br>
            <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>
            <a class="btn btn-success" href="{{route('page.edit',[$course->id,$page->id])}}" role="button">Изменить содержание</a>
            <br><br>
            <form action="{{route('page.destroy',[$course->id,$page->id])}}" method="post">
                @csrf
                @method('delete')
                <input class="btn btn-outline-danger" value="Удалить курс" type="submit">
            </form>
        </div>
        <br>
        <h5>Урок:  {{$page->name}}</h5>
        <div>
            @isset ($page->image)
                <img class="img-fluid" style="width: auto; height: 400px;" src="{{asset('/storage/' . $page->image)}}" alt="">
            @endisset
        </div>
        <div>
            {!! nl2br($page->text) !!}

        </div>
    </div>
@endsection
