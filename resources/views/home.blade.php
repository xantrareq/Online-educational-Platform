@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 p-3">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div>
                        <div>Вы вошли!</div>
{{--                        <div>email: {{ }}</div>--}}
                    </div>
                    @php
                        use Illuminate\Support\Facades\Auth;
                        $user = Auth::user();
                    @endphp
                    <div><p>Ваше имя {{$user->name}}</p></div>

                    <form class="gx-3 gy-2" action="{{route('auth.changepass',$user)}}" method="post" >
                        @csrf
                        <div><p>Сменить пароль</p></div>
                        <label for="pass" class="text-success">Введите пароль</label>
                        <input type="password" name="pass" class="form-control" id="pass">
                        <label for="new_pass" class="text-success">Новый пароль</label>
                        <input type="password" name="new_pass" class="form-control" id="new_pass">
                        <label for="new_pass2" class="text-success">Повторите пароль</label>
                        <input type="password" name="new_pass2" class="form-control" id="new_pass2">
                        <br>
                        <button type="submit" class="btn btn-outline-success">Сменить пароль</button>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
