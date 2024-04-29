<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Page;

class WelcomePage extends Controller
{

    public function main()
    {

        $courses = Course::all();
        return view('welcome', compact('courses'));


    }
    public function admin()
    {

        return view('adminpanel.course');
    }
}
