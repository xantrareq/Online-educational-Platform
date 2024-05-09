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

class StoreController extends Controller
{

    public function __invoke()
    {
        $request = request();

        $data = $request->validate([
            'title' => 'string|max:100',
            'description' => 'string|max:1200',
            'tags' => '',
            'image' => 'sometimes|file|max:102400'

        ]);
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        $path = "";
        if ($request->hasFile('preview')) {
            $path = $request->file('preview')->store('uploads', 'public');
        }
        $id = Auth::id();
        $data = $data + ['teacher_id'=>$id];
        $data = $data + ['preview'=>$path];
        $course = Course::create($data);
        $cu = ([
            'course_id' => $course->id,
            'user_id' => $id,
        ]);
        CourseUser::create($cu);
        if (isset($tags)) {
            $course->tags()->attach($tags);
        }

        return redirect()->route('course.my_courses');
    }

}
