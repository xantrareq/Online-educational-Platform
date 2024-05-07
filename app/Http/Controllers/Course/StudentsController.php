<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\CourseUser;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{

    public function __invoke(Course $course)
    {
        $userscourses = CourseUser::where(['course_id'=> $course->id])->paginate(10);
        return view('course.students', compact('course', 'userscourses'));

    }

}
