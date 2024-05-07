<?php

namespace App\Http\Controllers\Page;

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

class AnswerController extends Controller
{

    public function __invoke(Course $course,Page $page)
    {
        $request = request();
        $data = $request->validate([
            'answer'=>'',
        ]);

        $user_id = Auth::id();
        $page_id = $page->id;
        $up = PageUser::where(['user_id' => $user_id, 'page_id' => $page_id]) -> first();

//        if($up->points===null )
        if($up->points !== $page->points and $up->trys>0)
        {
            if($data['answer'] === $page->answer)
            {
                $up->update(['points'=>$page->points,'answer'=>$data['answer']]);
            }
            else
            {
                $up->update(['points'=>0,'answer'=>$data['answer']]);
            }
            $trys = $up->trys;
            $trys = $trys-1;
            $up->update(['trys'=>$trys]);
        }


        return redirect()->route('course_page.show', [$course->id,$page->id]);

    }

}
