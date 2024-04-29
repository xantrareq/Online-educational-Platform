@extends('layouts.main')
@section('content')
    <div>
        <h3>Курсы</h3>
        <div>
            <h5>Теги</h5>
            <div class="row m-0">
                @foreach($course->tags as $tag)
                    <div class="col-auto p-1">
                        <span class="badge bg-success">{{$tag->name}}</span>
                    </div>
                @endforeach
            </div>

            <form action="{{route('course.destroy',$course->id)}}" method="post">
                @csrf
                @method('delete')
                <a class="btn btn-outline-success" href="{{route('course.main')}}" role="button">Назад</a>
                <a class="btn btn-success" href="{{route('course.edit',$course->id)}}" role="button">Изменить содержание</a>
                <input class="btn btn-outline-danger" value="Удалить курс" type="submit">
            </form>
        </div>
        <br>
        <div>
            <h5>Курс "{{$course->title}}"</h5>
            <div>id учителя: {{$course->teacher_id}}</div>
            <div>
                {!! nl2br($course->description) !!}
            </div>
        </div>
        <a class="btn btn-outline-success" href="{{route('page.create',$course->id)}}" role="button">Добавить урок</a>

        <div>
            <style>
                .pagination .page-item.active .page-link {
                    background-color: darkseagreen;
                    border-color: green;
                    color: white;
                }
                .pagination .page-item .page-link {
                    color: forestgreen;
                }
            </style>

            <div>
                <style>
                    .pagination .page-item.active .page-link {
                        background-color: darkseagreen;
                        border-color: green;
                        color: white;
                    }
                    .pagination .page-item .page-link {
                        color: forestgreen;
                    }
                </style>
                <div>
                    {{$pages->links()}}
                </div>
            </div>

            @foreach($pages as $page)
                <a href="{{route('course_page.show',['course' => $course->id, 'page' => $page->id])}}"><img src="http://localhost:8000/myassets/eye.svg" width="60" height="15" alt="eye"></a>
                Урок:   {{$page->name}} <br>
            @endforeach





        </div>
    </div>
@endsection
