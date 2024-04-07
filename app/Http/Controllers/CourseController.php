<?php

namespace App\Http\Controllers;
use App\Models\Course;
class CourseController extends Controller
{

    public function main()
    {
        //$courses = CourseController::all();
        $courses = Course::all();
        return view('course.courses',compact('courses'));
    }

    public function create()
    {
        return view('course.create');
    }

    public function edit(Course $course)
    {

        return view('course.edit',compact('course'));
    }
    public function update(Course $course)
    {
        $data = request()->validate([
            'title'=>'string',
            'descryption'=>'string',
            'teacher_id'=>'int',
        ]);
        //$data['descryption'] = nl2br($data['descryption']);

        $course->update($data);
        return redirect()->route('course.show',$course->id);
    }
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('course.main');

    }

    public function store()
    {

        $data = request()->validate([
            'title'=>'string',
            'descryption'=>'string',
            'teacher_id'=>'int',
        ]);
        //$data['descryption'] = $data['descryption'].replace("\n", "&lt");
        Course::create($data);
        return redirect()->route('course.main');
    }

    public function show(Course $course)
    {

        return view('course.show',compact('course'));
    }


    public function register()
    {
        return view('register');

    }

}
