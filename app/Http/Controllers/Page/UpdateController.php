<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{

    public function __invoke(Course $course, Page $page)
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
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $str2 = $page->image;

            if ($str2 !== null) {
                Storage::disk('public')->delete($str2);
            }
        }
        else {
            $path = $page->image;
        }
        if ($request->has('check_delete_photo')) {
            Storage::disk('public')->delete($page->image);

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

        $page->update($dataWithImage);

        return redirect()->route('course_page.show', [$course->id, $page->id]);
    }


}
