<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShowController extends Controller
{

    public function __invoke(Course $course)
    {
        $pages = $course->pages()->paginate(7); // 10 - количество страниц на одной странице пагинации
        return view('course.show', compact('course','pages'));
    }

}
