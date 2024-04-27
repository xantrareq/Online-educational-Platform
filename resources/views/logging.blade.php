@extends('layouts.main')
@section('content')
    <div>
        <section class="vh-100 bg-image"
                 style="background-color: gray">
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <a href="{{route('welcome_page')}}">

                                        <button type="submit"
                                                class="close position-absolute top-12 end-0 translate-middle"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </a>
                                    <h2 class="text-uppercase text-center mb-5">Вход</h2>
                                    <form>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example1cg">Логин</label>
                                            <input type="text" id="form3Example1cg"
                                                   class="form-control form-control-lg"/>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form3Example4cg">Пароль</label>
                                            <input type="password" id="form3Example4cg"
                                                   class="form-control form-control-lg"/>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="button"
                                                    class="btn btn-success btn-block btn-lg gradient-custom-4">Войти
                                            </button>
                                        </div>

                                        <p class="text-center text-muted mt-5 mb-0"><a href="register"
                                                                                       class="fw-bold text-body"><u>Регистрация</u></a>
                                        </p>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
