@extends('layouts.main')
@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <div>
        <div class="p-4">
            <h3>Изменить урок "{{$page->name}}" Курса "{{$course->title}}"</h3>
        </div>



    <form class="gx-3 gy-2" action="{{route('page.update', ['course' => $course->id,$page->id])}} " method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="col col-sm-5">
            <a class="btn btn-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>
            <br>
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" value="{{$page->name}}" class="form-control" id="name">
            @error('name')
            <p class="text-danger">Введите название</p>
            @enderror
            <br>
        </div>

        <div class="col col-sm-12">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
            <script src="assets/plugins/summernote/lang/summernote-ru-RU.js"></script>
            @error('text')
            <p class="text-danger">Введите содержание</p>
            @enderror
            <label for="text">Содержание урока</label><textarea name="text" class="form-control" id="text">{{$page->text}}</textarea>
            <br>
            <script>
                $(document).ready(function() {
                    $('#text').summernote({
                        lang:'ru-RU',
                        placeholder: 'text',
                        tabsize:2,
                        height:300
                    })
                });
            </script>

        </div>




        <div class="col col-sm-5 p-5">
            <label for="homework_condition">Домашнее задание</label>
            <textarea name="homework_condition" class="form-control"  id="homework_condition">{{$page->homework_condition}}</textarea>
            <br>
            <label for="answer" class="form-label">Ответ на домашнее задание</label>
            <input type="text" name="answer" value="{{$page->answer}}" class="form-control" id="answer">
            <br>
            <label for="points" class="form-label">Баллы за задание</label>
            <input type="text" name="points" class="form-control" value="{{$page->points}}" id="points">
            <br>
            <label for="trys" class="form-label">Попытки</label>
            <input type="text" name="trys" value="{{$page->trys}}" class="form-control" id="trys">
            <br>
            <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#myModal">
                Изменить урок
            </button>
        </div>
        <div>
            <br>
        </div>
        <!-- Всплывающее окно -->
        <div class="modal" tabindex="-1" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Изменение страницы</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <p>Изменить страницу?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-success">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
