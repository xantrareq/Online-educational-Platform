<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class ListController extends Controller
{

    public function __invoke()
    {
        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'teacher_id' => 'int',
            'tags' => '',
        ]);

        $query = Course::query();
        if (isset($data['teacher_id'])) {
            $query->where('teacher_id', $data['teacher_id'])->get();

        }
        if (isset($data['title'])) {
            $query->where('title', 'like', "%{$data['title']}%");
        }

        if (isset($data['tags'])) {
            $tags = $data['tags'];
            $tags = explode(',', $tags);

            $query->whereHas('tags', function ($query) use ($tags) {
                $query->whereIn('name', $tags);
            });
        }
        $courses = $query->paginate(10);
//        $courses = Course::paginate(10);
        $tags = Tag::all();
        return view('course.courses', compact('courses', 'tags'));
    }

}
