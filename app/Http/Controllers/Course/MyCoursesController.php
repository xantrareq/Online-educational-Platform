<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\CourseUser;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyCoursesController extends Controller
{

    public function __invoke()
    {
        $user_id = Auth::id();
        $tags = Tag::all();
        $user_courses = CourseUser::where('user_id', $user_id);

        $course_ids = $user_courses->pluck('course_id');

        $courses = Course::whereIn('id', $course_ids)->paginate(10);

        return view('course.mycourses', compact('courses', 'tags'));

    }

}
