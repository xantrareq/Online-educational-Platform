<?php

namespace App\Http\Controllers;
use App\Models\Course;
class WelcomePage extends Controller
{

    public function main()
    {
        //return 'Добро пожаловать)<br/>Ссылки:<br/>http://127.0.0.1:8000/1<br/>http://127.0.0.1:8000/2';
//        $course = CourseController::find(1);
//        dump($course->title);
//        return 1;

//        $courses = CourseController::all(); //Вывод всех названий бд
//        foreach ($courses as $course) {
//            dump($course->title);
//        }
        $courses = Course::all();
        return view('welcome',compact('courses'));
        //return 'Я НЕНАВИЖУ PHP  <br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br/>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';


    }
    public function ind1(): string
    {
        return 'Л0Х';
    }
    public function ind2(): string
    {
        return '4m0';
    }
    public function create(): void
    {
        $courseArr = [
            [
            'title' => 'Hihiheha',
            'descryption' => 'Ahihihie?Hihehea',
            'teacher_id' => '1'
            ],[
            'title' => 'Another Hihiheha',
            'descryption' => 'Another Ahihihie?Hihehea',
            'teacher_id' => '1'
            ],
        ];
        Course::create([
            'title' => 'Hihiheha',
            'descryption' => 'Ahihihie?Hihehea',
            'teacher_id' => '1',
         ]);
        dd('created');
    }
    public function delete(): void
    {

//        $course = CourseController::withTrashed()->find(2); //Поиск в мусорке
//        $course->restore(); //Восстановление
        $course = Course::find(2);
        $course->delete();
        dd('deleted');
    }
}
