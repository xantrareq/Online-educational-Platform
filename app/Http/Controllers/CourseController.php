<?php

namespace App\Http\Controllers;
use App\Models\Course;
class CourseController extends Controller
{

    public function main()
    {
        //$courses = CourseController::all();
        $courses = Course::all();
        return view('course.courses_list',compact('courses'));
    }

    public function create()
    {
        return view('course.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title'=>'string',
            'descryption'=>'string',
            'teacher_id'=>'int',
        ]);
        Course::create($data);
        return redirect()->route('course_list.main');
    }

    public function show(Course $course)
    {

        return view('course.show',compact('course'));
    }

}
