<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\CourseUser;
use App\Models\LikedCourse;
use App\Models\Page;
use App\Models\PageUser;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UnLikeCourseController extends Controller
{

    public function __invoke(Course $course)
    {
        $user_id = Auth::id();
        $courseId = $course->id;
        $likes = $course->likes - 1;
        $course->update(['likes'=>$likes]);

        $lc = LikedCourse::where(['user_id' => $user_id, 'course_id' => $courseId]);
        $lc->update(['visible'=>false]);
//
//        $course = Course::find($courseId);
//        $pages = $course->pages()->get();
//
//        foreach ($pages as $page) {
//            PageUser::where(['user_id' => $user_id, 'page_id' => $page->id])->delete();
//        }

        return redirect()->route('course.show', $course->id);

    }

}
