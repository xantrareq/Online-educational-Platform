@extends('layouts.main')
@section('content')
    <div class="container-fluid ">
        <br>
        <div class="row ">
            <div class="col-sm-1 col-md-1"></div>

            <div class="col-sm-10 col-md-10 card">
                <h3>Мои курсы</h3>
                @php
                    use Illuminate\Support\Facades\Auth;
                    $userId = Auth::id();
                @endphp
                <div>
                    @if($userId)
                        <a class="btn btn-success" href="{{route('course.create')}}" role="button">Создать курс</a>
                    @else
                        <span>Авторизуйтесь, чтобы создавать курсы.</span>
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
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center justify-content-center">
                                            <div class="flex-fill align-items-center">
                                                <a href="{{route('course.show',$course->id)}}">
                                                    <img src="http://localhost:8000/myassets/eye.svg" width="60" height="15"
                                                         alt="eye">
                                                </a>
                                            </div>
                                            <div class="flex-fill">
                                                @isset ($course->preview)
                                                    @if ($course->preview != "" && Storage::exists('public/' . $course->preview))
                                                        <img class="img-fluid" style="width: auto; height: 60px;"
                                                             src="{{asset('/storage/' . $course->preview)}}" alt="">
                                                    @else
                                                        <img src="http://localhost:8000/myassets/Frame3.svg" width="60"
                                                             height="60"
                                                             alt="eye">
                                                    @endif
                                                @endisset
                                            </div>
                                            <div class="flex-fill">
                                                <img src="http://localhost:8000/myassets/blue_heart.svg" width="25"
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
