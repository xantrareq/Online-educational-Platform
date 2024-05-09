@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 p-3">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <div>
                            <div>Вы успешно сменили пароль!</div>
                            {{--                        <div>email: {{ }}</div>--}}
                        </div>
                        @php
                            use Illuminate\Support\Facades\Auth;
                            $user = Auth::user();
                        @endphp
                        <div><p>Ваше имя {{$user->name}}</p></div>
                        <a class="btn btn-outline-success" href="{{route('home')}}" role="button">Назад</a>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
