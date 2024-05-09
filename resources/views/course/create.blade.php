@extends('layouts.main')
@section('content')
    <div>

        <h3>Создать курс</h3>
        <a class="btn btn-outline-success" href="{{route('course.my_courses')}}" role="button">Назад</a>

        <form class="gx-3 gy-2" action="{{route('course.store')}}" method="post" enctype="multipart/form-data">
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
            {{--            <div class="col col-sm-1">--}}
            {{--                <label for="teacher_id" class="form-label">id учителя</label>--}}
            {{--                <input type="text" name="teacher_id" class="form-control" id="teacher_id">--}}
            {{--                <br>--}}
            {{--            </div>--}}
            <div>
                <label for="tags">Теги</label>
                <div class="container-fluid">
                    <div class="row">
                        @foreach($tags as $index => $tag)
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$tag->id}}"
                                           id="tag{{$tag->id}}"
                                           name="tags[]" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="tag{{$tag->id}}">
                                        {{$tag->name}}
                                    </label>
                                </div>
                            </div>
                            @if (($index + 1) % 6 == 0)
                    </div>
                    <div class="row">
                        @endif
                        @endforeach
                    </div>
                </div>

            </div>
            <div>
                <h5>Превью</h5>
                <div class="form-group">
                    <input type="file" name="preview">
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                Создать курс
            </button>
            <!-- Всплывающее окно -->
            <div class="modal" tabindex="-1" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Создание курса</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <p>Создать курс?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
