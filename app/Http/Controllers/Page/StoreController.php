<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    public function __invoke(Course $course)
    {
        $request = request();

        $data = $request->validate([
            'name' => 'required|max:255',
            'text' => 'required',
            'homework_condition' => 'sometimes',
            'answer' => 'sometimes',
            'points' => 'sometimes',
            'trys' => 'sometimes|integer',
            'youtube_link' => 'nullable|url',
        ]);
        $path = "";
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
        }

        if (isset($data['youtube_link'])) {
            $youtube_link = $data['youtube_link'];
            $parts = explode('=', $youtube_link);
            if (count($parts) > 1) {
                $value = $parts[1];
                $data['youtube_link'] = "https://www.youtube.com/embed/".$parts[1];
            }
        }
        $dataWithImage = $data + ['image' => $path];

        $page = Page::create($dataWithImage);

        $cid = $course->id;
        $pid = $page->id;
        CoursePage::create(['course_id' => $cid, 'page_id' => $pid]);

        return redirect()->route('course.show', ['course' => $course->id]);
    }


}
