<?php

namespace App\Http\Controllers;
use App\Models\Course;
class CoursesListPage extends Controller
{

    public function main()
    {
        //$courses = Course::all();
        $courses = Course::all();
        return view('courses_list',compact('courses'));
    }

}
