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

class LikeCourseController extends Controller
{

    public function __invoke(Course $course)
    {
        $user_id = Auth::id();
        $courseId = $course->id;
        $lc = LikedCourse::where(['user_id' => $user_id, 'course_id' => $courseId]) -> first();
        if($lc === null)
        {
            $lu = ([
                'user_id' => $user_id,
                'course_id' => $course->id,

            ]);
            LikedCourse::create($lu);
            $likes = $course->likes + 1;
            $course->update(['likes'=>$likes]);
            $pages = $course->pages()->get();
            foreach ($pages as $page){
                PageUser::create(['user_id'=>$user_id,'page_id'=>$page->id,'trys'=>$page->trys]);
            }
        }
        else
        {
            $likes = $course->likes + 1;
            $course->update(['likes'=>$likes]);
            $lc = LikedCourse::where(['user_id' => $user_id, 'course_id' => $courseId]) -> first();
            $lc->update(['visible'=>true]);
        }


        return redirect()->route('course.show', $course->id);

    }

}
