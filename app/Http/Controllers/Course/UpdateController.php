<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{

    public function __invoke(Course $course)
    {
        $request = request();

        $data = $request->validate([
            'title' => 'string|max:100',
            'description' => 'string|max:1200',
            'tags' => '',
            'image' => 'sometimes|file|max:102400',
            'min_points' => 'nullable|min:1|max:15',
            'points_four' => 'nullable|min:1|required_with:points_five|max:15',
            'points_five' => 'nullable|min:1|required_with:points_four|max:15',

        ]);
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        $path = "";
        if ($request->hasFile('preview')) {
            $path = $request->file('preview')->store('uploads', 'public');
            $str2 = $course->preview;
            Storage::disk('public')->delete($str2);
        }
        $data = $data + ['preview'=>$path];

        $course->update($data);
        if (isset($tags)){
            $course->tags()->sync($tags);
        }
        else{
            $course->tags()->detach();
        }
        return redirect()->route('course.show', $course->id);
    }

}
