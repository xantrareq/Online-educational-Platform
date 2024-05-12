@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            @php
                use App\Models\User;
            @endphp

            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-10 col-md-10">
                <br>
                <h3>Результаты курса {{$course->title}}</h3>
                <div class="p-1">
                    <a class="btn btn-outline-success" href="{{route('course.show',$course->id)}}"
                       role="button">Назад</a>

                </div>

                {{$userscourses->withQueryString()->links()}}
                <div>
                    <div class="row">

                        @foreach($userscourses as $cour)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-center">
                                        <div class="flex-fill align-items-center">
                                            @php
                                                $usrId = $cour->user_id;
                                                $user = User::where('id',$usrId)->first();
                                                $name = $user->name;
                                                $pageIds = \App\Models\CoursePage::where('course_id', $course->id)->pluck('page_id');
                                                $user_pages = \App\Models\PageUser::where('user_id', $usrId)->whereIn('page_id', $pageIds)->get();
                                                $result = 0;
                                                foreach ($user_pages as $up){
                                                    if($up and $up->points){
                                                        $result += $up->points;
                                                    }
                                                }
                                                $passed = 0;
                                                if($result>=$course->min_points){
                                                    $passed = 1;
                                                }
                                                $sum = 0;
                                                foreach ($pageIds as $pid){
                                                    $page =\App\Models\Page::where(['id' => $pid]) -> first();
                                                    if($page and $page->points){
                                                        $sum += $page->points;
                                                    }
                                                }

                                            @endphp

                                        </div>
                                        <div class="flex-fill">
                                            <p class="card-text">id {{$usrId}}</p>
                                        </div>
                                        <div class="flex-fill">
                                            <p class="card-text">Имя {{$name}}</p>
                                        </div>
                                        @php
                                            $min_points = $course->min_points;
                                            $mark = 2;
                                            if($result >= $min_points)
                                                $mark = 3;
                                            if($result >= $course->points_four)
                                                $mark = 4;
                                            if($result >= $course->points_four)
                                                $mark = 5;
                                        @endphp
                                        @if($course->points_four)
                                            <div class="flex-fill">
                                                <p class="card-text" style="color: green">Оценка: {{$mark}} </p>
                                            </div>

                                        @endif
                                        @if($passed)

                                            <div class="flex-fill">
                                                @if($course->min_points !== null and $course->min_points !== 0)
                                                    <p class="card-text" style="color:green">Результат {{$result}}
                                                        /{{$course->min_points}} проходных</p>
                                                @else
                                                    <p class="card-text " style="color:green">Результат {{$result}}</p>
                                                @endif

                                            </div>
                                        @else
                                            <div class="flex-fill">
                                                @if($course->min_points !== null and $course->min_points !== 0)
                                                    <p class="card-text " style="color:red">Результат {{$result}}
                                                        /{{$course->min_points}} проходных</p>
                                                @else
                                                    <p class="card-text " style="color:red">Результат {{$result}}</p>
                                                @endif

                                            </div>
                                        @endif
                                        <div class="flex-fill">
                                            <p class="card-text " style="color:#0e5b44">Макс кол-во баллов {{$sum}}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-1"></div>
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

    .dropdown-menu {
        width: 400px; /* Автоматическая ширина */
    }

</style>



