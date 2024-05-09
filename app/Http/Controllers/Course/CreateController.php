<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class CreateController extends Controller
{

    public function __invoke()
    {

        $tags = Tag::all();
        return view('course.create', compact('tags'));

    }

}
