@extends('layouts.main')
@section('content')
    <div class="container-fluid ">
        <br>
        <div class="row ">
            <div class="col-sm-1 col-md-1"></div>

            <div class="col-sm-10 col-md-10 card">
                <div>
                    <h3>Урок: {{$page->name}}</h3>
                    <form action="{{route('page.destroy',[$course->id,$page->id])}}" method="post">
                        @csrf
                        @method('delete')
                        <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>
                        @php
                            use Illuminate\Support\Facades\Auth;
                            $userId = Auth::id();
                            $courseTeacherId = $course->teacher_id;
                        @endphp
                        @if($userId == $courseTeacherId)
                            <a class="btn btn-success" href="{{route('page.edit',[$course->id,$page->id])}}"
                               role="button">Изменить
                                содержание</a>
                            <input class="btn btn-outline-danger" value="Удалить страницу" type="submit">
                        @endif
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
                        <img class="img-fluid" style="width: auto; height: 400px;"
                             src="{{asset('/storage/' . $page->image)}}"
                             alt="">
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
        </div>
    </div>

@endsection
