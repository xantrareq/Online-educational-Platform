@extends('layouts.main')
@section('content')
    <div>
        <div>
            <h3>Урок: {{$page->name}}</h3>
            <form action="{{route('page.destroy',[$course->id,$page->id])}}" method="post">
                @csrf
                @method('delete')
                <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>
                <a class="btn btn-success" href="{{route('page.edit',[$course->id,$page->id])}}" role="button">Изменить содержание</a>

                <input class="btn btn-outline-danger" value="Удалить страницу" type="submit">
            </form>
        </div>
        <br>
        <div>
                <div>
                    @isset($page->youtube_link)
                        <h4>Видео</h4>
                        <iframe width="560" height="315" src={{$page->youtube_link}}  allowfullscreen></iframe>
                    @endisset
                </div>


            @isset ($page->image)
                <img class="img-fluid" style="width: auto; height: 400px;" src="{{asset('/storage/' . $page->image)}}" alt="">
            @endisset
        </div>
        <div>
            {!! nl2br($page->text) !!}
        </div>
        <div>
            @isset($page->homework_condition)
                <h5>Домашнее задание</h5>
                {!! nl2br($page->homework_condition) !!}
            @endisset
        </div>
        <div>
            @isset($page->homework_condition)
                <h5>Ответ</h5>
                {!! nl2br($page->answer) !!}
            @endisset
        </div>
    </div>
@endsection
