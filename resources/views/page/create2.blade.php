@extends('layouts.main')
@section('content')



        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


    <div>
        <div class="p-4">
            <h3>Добавить страницу курсу {{$course->title}}</h3>
        </div>
        <form class="gx-3 gy-2" action="{{route('page.store', ['course' => $course->id])}} " method="post"
              enctype="multipart/form-data">

            @csrf
            <div class="col col-sm-5">
                <a class="btn btn-success" href="{{route('course.show',$course->id)}}" role="button">Назад</a>
                <br>
                <label for="name" class="form-label">Название</label>
                <input type="text" name="name" class="form-control" id="name">
                <br>
            </div>
            @error('name')
            <p class="text-danger">Введите название</p>
            @enderror
            <div class="col col-sm-12">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
                <script src="assets/plugins/summernote/lang/summernote-ru-RU.js"></script>

                <label for="text"></label><textarea name="text" class="form-control" id="text"></textarea>
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



            @error('text')
            <p class="text-danger">Введите текст</p>
            @enderror
            <div class="col col-sm-5 p-5">
                <label for="homework_condition">Домашнее задание</label>
                <textarea name="homework_condition" class="form-control" id="homework_condition"></textarea>
                <br>
                @error('homework_condition')
                <p class="text-danger">Введите текст</p>
                @enderror
                <label for="answer" class="form-label">Ответ на домашнее задание</label>
                <input type="text" name="answer" class="form-control" id="answer">
                <br>
                @error('answer')
                <p class="text-danger">Введите текст</p>
                @enderror
                <label for="points" class="form-label">Баллы за задание</label>
                <input type="text" name="points" class="form-control" id="points">
                <br>
                @error('points')
                <p class="text-danger">Введите текст</p>
                @enderror
                <label for="trys" class="form-label">Попытки</label>
                <p class="text-gray">макс - 50</p>
                <input type="text" name="trys" class="form-control" id="trys">
                <br>
                @error('trys')
                <p class="text-danger">Введите попытки</p>
                @enderror
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
                    Создать урок
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
                            <h5 class="modal-title">Создание урока</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            <p>Создать урок?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            <button type="submit" class="btn btn-success">Создать урок</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection


