@extends('layouts.main')
@section('content')
    <div>

        <h3>Создать курс</h3>


        <a class="btn btn-outline-success" href="{{route('course.main')}}" role="button">Назад</a>

        <form class="gx-3 gy-2" action="{{route('course.store')}}" method="post">
            @csrf

            <div class="col col-sm-5">
                <label for="title" class="form-label">Название</label>
                <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}">
                <br>
                @error('title')
                <p class="text-danger">Введите название</p>
                @enderror
            </div>
            <div class="col col-sm-5">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" id="description">{{old('description')}}</textarea>
                @error('description')
                <p class="text-danger">Введите описание</p>
                @enderror
                <br>
            </div>
            <div class="col col-sm-1">
                <label for="teacher_id" class="form-label">id учителя</label>
                <input type="text" name="teacher_id" class="form-control" id="teacher_id">
                <br>
            </div>
            <div>
                <label for="tags">Теги</label>
                @foreach($tags as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag{{$tag->id}}"
                               name="tags[]" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                        <label class="form-check-label" for="tag{{$tag->id}}">
                            {{$tag->name}}
                        </label>
                    </div>
                @endforeach
            </div>
            <br>
            <button type="submit" class="btn btn-success">Создать курс</button>
        </form>
    </div>
@endsection
