<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{

    public function __invoke(Course $course, Page $page)
    {
        $str2 = $page->image;
        Storage::disk('public')->delete($str2);
        $cid = $course->id;
        $pid = $page->id;
        $course_page = CoursePage::where(['course_id' => $cid, 'page_id' => $pid]);
        $course_page->delete();
        $page->delete();

        return redirect()->route('course.show', $course->id);

    }


}
