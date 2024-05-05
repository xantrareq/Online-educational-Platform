@extends('layouts.main')
@section('content')
    <div>
        <h3>Изменить содержание курса "{{$course->title}}"</h3>
        <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>

        <form class="gx-3 gy-2" action="{{route('course.update',$course->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="col col-sm-5">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$course->title}}">
                <br>
            </div>
            @error('title')
            <p class="text-danger">Введите название</p>
            @enderror
            <div class="col col-sm-5">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" id="description">{{$course->description}}</textarea>

                <br>
            </div>
            @error('description')
            <p class="text-danger">Введите описание</p>
            @enderror
{{--            <div class="col col-sm-1">--}}
{{--                <label for="teacher_id" class="form-label">id учителя</label>--}}
{{--                <input type="text" name="teacher_id" class="form-control" id="teacher_id"--}}
{{--                       value="{{$course->teacher_id}}">--}}
{{--                <br>--}}
{{--            </div>--}}

            <div>
                <label for="tags">Теги</label>
                @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="{{$tag->id}}"
                               name="tags[]"
                        @foreach($course->tags as $CourseTag)
                            {{$tag->id === $CourseTag->id ? 'checked' : ''}}
                            @endforeach
                            {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}
                        >
                        <label class="form-check-label" for="{{$tag->id}}">
                            {{$tag->name}}
                        </label>
                    </div>
                @endforeach

            </div>
            <div>
                <h5>Превью</h5>
                <div class="form-group">
                    <input type="file" name="preview">
                </div>
            </div>
            <button type="submit" class="btn btn-success">Изменить запись</button>
        </form>
    </div>
@endsection
