<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\CourseUser;
use App\Models\Page;
use App\Models\PageUser;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{

    public function __invoke(Course $course,User $user)
    {
        $userName = $user->name;
//        $UsersCourses = CourseUser::where(['user_id'=> $user->id,'course_id'=>$course->id])-first();
        $pageIds = CoursePage::where('course_id', $course->id)->pluck('page_id');
        $userPages = PageUser::where('user_id', $user->id)->whereIn('page_id', $pageIds)->paginate(10);
//        dd($userPages);
        return view('course.results', compact('userPages','userName','course'));


    }

}
