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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShowLikedController extends Controller
{

    public function __invoke(Course $course)
    {
        $user_id = Auth::id();
        $tags = Tag::all();
        $user = User::where('id',$user_id)->first();
//        dd($user);
        $courses = $user->courses()->paginate(10);

        return view('course.likedcourses', compact('courses', 'tags'));

    }

}
