@extends('layouts.main')
@section('content')
    <div class="container-fluid ">
        <br>
        <div class="row ">
            <div class="col-sm-1 col-md-1"></div>

            <div class="col-sm-10 col-md-10 card">
                <h3>Избранные курсы</h3>
                @php
                    use Illuminate\Support\Facades\Auth;
                    use App\Models\PageUser;
                    $userId = Auth::id();
                @endphp
                <div>
                    @if($userId === null)
                        <span>Авторизуйтесь, чтобы иметь избранное.</span>
                    @endif
                </div>
                <div><br></div>
                <div>
                    <div>
                        {{$courses->withQueryString()->links()}}
                    </div>

                    <div>
                        <div class="row">

                            @foreach($courses as $course)
                                @php
                                    $userId = Auth::id();
                                    $liked = \App\Models\LikedCourse::where(['user_id'=>$userId,'course_id'=>$course->id])->first();
                                    $vis = 0;
                                    if($liked !== null and $liked->visible!=0){
                                        $vis = 1;
                                    }

                                @endphp
                                @if($vis)

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body d-flex align-items-center justify-content-center">
                                                <div class="flex-fill align-items-center">
                                                    <a href="{{route('course.show',$course->id)}}">
                                                        <img src="http://localhost:8000/myassets/eye.svg" width="60"
                                                             height="15"
                                                             alt="eye">
                                                    </a>
                                                </div>
                                                <div class="flex-fill">
                                                    @isset ($course->preview)
                                                        @if ($course->preview != "" && Storage::exists('public/' . $course->preview))
                                                            <img class="img-fluid" style="width: auto; height: 60px;"
                                                                 src="{{asset('/storage/' . $course->preview)}}" alt="">
                                                        @else
                                                            <img src="http://localhost:8000/myassets/Frame3.svg"
                                                                 width="60"
                                                                 height="60"
                                                                 alt="eye">
                                                        @endif
                                                    @endisset
                                                </div>
                                                <div class="flex-fill">
                                                    <img src="http://localhost:8000/myassets/green_heart.svg" width="25"
                                                         height="25"
                                                         alt="like">
                                                    <a>{{$course->likes}}</a>
                                                </div>
                                                <div class="col-9">
                                                    <h5 class="card-title"><a>{{$course->title}}</a></h5>
                                                    <p class="card-text">{{$course->description}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>


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
</style>
