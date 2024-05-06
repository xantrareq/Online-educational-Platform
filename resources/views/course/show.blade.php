@extends('layouts.main')
@section('content')
    <div class="container-fluid ">
        <br>
        <div class="row ">
            <div class="col-sm-1 col-md-1"></div>

            <div class="col-sm-10 col-md-10 card">

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
                        @php
                            use Illuminate\Support\Facades\Auth;
                            $userId = Auth::id();
                            $courseTeacherId = $course->teacher_id;
                        @endphp

                        @if($userId == $courseTeacherId)
                            <a class="btn btn-success" href="{{route('course.edit',$course->id)}}" role="button">Изменить
                                содержание</a>
                            <input class="btn btn-outline-danger" value="Удалить курс" type="submit">
                        @endif
                    </form>
                </div>
                <br>
                <div>
                    <h5>Курс "{{$course->title}}"</h5>
                    @php
                        use App\Models\PageUser;
                        $userId = Auth::id();
                        $liked = \App\Models\LikedCourse::where(['user_id'=>$userId,'course_id'=>$course->id])->first();
                        $sum = 0;
                        $result = 0;
                    @endphp
                    @foreach($pages as $page)
                        @php
                            $sum += $page->points;
                        @endphp
                    @endforeach
                    @foreach($pages as $page)
                        @php
                            $p=PageUser::where(['user_id'=>$userId,'page_id'=>$page->id])->first();
                            $result+=$p->points;

                        @endphp
                    @endforeach
                    @if($liked !== null)
                        @php
                            $result = $result/$sum;
                        @endphp
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: {{$sum}}%">{{$result*100}}%</div>
                        </div>
                    @endif
                    <div>id курса: {{$course->id}}</div>
                    @php
                        use App\Models\User;
                        $id = $course->teacher_id;
                        $user = User::find($id);
                        if($user!==null){
                            $name = $user->name;
                        }
                    @endphp
                    @isset($name)
                        <div>автор курса: {{$name}}</div>
                    @endisset
                    <div>
                        <h5>Описание курса</h5>
                        {!! nl2br($course->description) !!}
                    </div>
                </div>
                <div>
                    @if($userId == $courseTeacherId)
                        <a class="btn btn-outline-success" href="{{route('page.create',$course->id)}}" role="button">Добавить
                            урок</a>
                    @endif
                </div>


                <div>


                    <div>

                        <div>
                            {{$pages->links()}}
                        </div>
                    </div>

                    @foreach($pages as $page)
                        <a href="{{route('course_page.show',['course' => $course->id, 'page' => $page->id])}}"><img
                                src="http://localhost:8000/myassets/eye.svg" width="60" height="15" alt="eye"></a>
                        Урок:   {{$page->name}} <br>
                    @endforeach


                </div>
            </div>
        </div>
        </div>

        @endsection

        <style>
            .pagination .page-item.active .page-link {
                background-color: darkseagreen;
                border-color: green;
                color: white;
            }

            .pagination .page-item .page-link {
                color: forestgreen;
            }

            .pagination .page-item.active .page-link {
                background-color: darkseagreen;
                border-color: green;
                color: white;
            }

            .pagination .page-item .page-link {
                color: forestgreen;
            }
        </style>
