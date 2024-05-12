<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\CourseUser;
use App\Models\LikedCourse;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{

    public function __invoke(Course $course)
    {
        $course_pages = CoursePage::where(['course_id' => $course->id]);
        $cid = $course->id;
        $course_pages->each(function ($course_page) use ($cid){
            $pid = $course_page->page_id;
            $page =  Page::where(['id' => $pid]);
            $page->each(function ($p) {
                if ($p->image && Storage::disk('public')->exists($p->image)) {
                    Storage::disk('public')->delete($p->image);
                    $p->delete();
                }


            });


            $course_page->delete();
        });

        $str2 = $course->preview;
        Storage::disk('public')->delete($str2);
        $coursetags = CourseTag::where(['course_id'=>$course->id]);
        $coursetags->delete();
        $course_users = CourseUser::where(['course_id'=>$course->id]);
        $course_users->delete();
        $liked = LikedCourse::where(['course_id'=>$course->id]);
        $liked->delete();

        $course->delete();

        return redirect()->route('course.main');
    }

}
