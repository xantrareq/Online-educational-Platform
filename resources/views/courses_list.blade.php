@extends('layouts.main')
@section('content')
<div>
    <table class="table">
        <thead class = "table-info">
        <tr>
            <th>#</th>
            <th>Название курса</th>
            <th>Описание курса</th>
            <th>Id учителя</th>
        </tr>
        </thead>
        <tbody>
        @foreach($courses as $course)
            <tr>
                <th scope="row">{{$course->id}}</th>
                <td>{{$course->title}}</td>
                <td>{{$course->descryption}}</td>
                <td>{{$course->teacher_id}}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
@endsection
