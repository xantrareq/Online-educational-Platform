<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class ShowController extends Controller
{

    public function __invoke(Course $course, Page $page)
    {
        return view('page.show', compact('page', 'course'));
    }

}
