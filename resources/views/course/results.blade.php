@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row ">
            @php
                use App\Models\Page;
            @endphp

            <div class="col-1 col-1"></div>
            <div class="col-10 col-10">
                <br>
                <h3>Результаты {{$userName}} </h3>
                <div class="p-1">
                    <a class="btn btn-outline-success" href="{{route('course.students',$course->id)}}"
                       role="button">Назад</a>
                </div>

                {{$userPages->withQueryString()->links()}}

                @foreach($userPages as $upage)
                    @php
                        $page = Page::where('id',$upage->page_id)->first();
                        $vis = 0;
                        if($page->points !== null)
                            $vis = 1;
                    @endphp
                    @if($vis === 1)
                        <div class="card">
                            <div class="card-body  align-items-center justify-content-center">
                                <div class="flex-fill align-items-center">
                                    <div class="flex-fill">
                                        Урок: {{$page->name}}
                                    </div>
                                    <div class="flex-fill">
                                        Результат: {{$upage->points}}
                                    </div>
                                    <div class="flex-fill">
                                        Время выполнения: {{$upage->time}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>


    </div>

    <div class="col-sm-1"></div>

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



