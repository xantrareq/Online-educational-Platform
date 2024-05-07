@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            @php
                use App\Models\Page;
            @endphp

            <div class="col-sm-1 col-md-1"></div>
            <div class="col-sm-10 col-md-10">
                <br>
                <h3>Результаты {{$userName}} </h3>
                <a class="btn btn-outline-success" href="{{route('course.students',$course->id)}}" role="button">Назад</a>
                {{$userPages->withQueryString()->links()}}
                <div>
                    <div class="row">
                        @foreach($userPages as $upage)
                            @php
                                $page = Page::where('id',$upage->page_id)->first();
                                $vis = 0;
                                if($page->points !== null)
                                    $vis = 1;
                            @endphp
                            @if($vis === 1)
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body d-flex align-items-center justify-content-center">
                                            <div class="flex-fill align-items-center">

                                                <div class="flex-fill">
                                                    Урок: {{$page->name}}
                                                </div>
                                                <div class="flex-fill">
                                                    Результат: {{$upage->points}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
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



