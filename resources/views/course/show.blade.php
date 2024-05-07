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

                        @if($userId === $courseTeacherId and $userId !== null)
                            <a class="btn btn-success" href="{{route('course.edit',$course->id)}}" role="button">Изменить
                                содержание</a>
                            <input class="btn btn-outline-danger" value="Удалить курс" type="submit">
                            <a class="btn btn-outline-success" href="{{route('course.students',$course->id)}}" role="button">Просмотр результатов</a>
                        @endif
                        @php
                            use App\Models\PageUser;
                            use App\Models\LikedCourse;
                            $userId = Auth::id();
                            $liked = \App\Models\LikedCourse::where(['user_id'=>$userId,'course_id'=>$course->id])->first();
                            $vis = 0;
                            if($liked !== null and $liked->visible!=0){
                                $vis = 1;
                            }
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
                                if($p !== null){
                                    $result+=$p->points;
                                }
                            @endphp
                        @endforeach
                    </form>
                </div>
                <a>Добавило в избаранное: {{$course->likes}}</a>
                @if($vis)
                    <div>
                        <a href="{{route('course.unlike',$course)}}">
                            <img src="http://localhost:8000/myassets/green_heart.svg" width="40"
                                 height="40"
                                 alt="like">
                        </a>
                        <a>Добавлено в избранное</a>
                    </div>
                @else
                    <div>
                        <a href="{{route('course.like',$course)}}">
                            <img src="http://localhost:8000/myassets/blue_heart.svg" width="40"
                                 height="40"
                                 alt="like">
                        </a>
                        <a>Добавить в избранное</a>
                    </div>
                @endif
                <br>
                <div>

                    <h5>Курс "{{$course->title}}"</h5>

                    @if($liked !== null and $sum!=0)
                        @php
                            $result = $result/$sum;
                        @endphp
                        <div>Выполнено {{$result*100}}%</div>
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: {{$result*100}}%"></div>
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

                        </div>
                    </div>
                    @php
                        $courseId = $course->id;
                        $userId = Auth::id();
                        $userCourse = LikedCourse::where(['user_id'=>$userId,'course_id'=>$courseId])->first();
                    @endphp
                    @if($userCourse !== null)
                        @if($userCourse->visible != 0)
                            {{$pages->links()}}
                            @foreach($pages as $page)
                                <a href="{{route('course_page.show',['course' => $course->id, 'page' => $page->id])}}"><img
                                        src="http://localhost:8000/myassets/eye.svg" width="60" height="15"
                                        alt="eye"></a>
                                Урок:   {{$page->name}} <br>
                            @endforeach
                        @endif
                    @endif


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
