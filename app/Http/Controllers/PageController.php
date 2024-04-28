<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursePage;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

    public function main()
    {
        dd(1);
    }

    public function show(Page $page)
    {

        return view('page.show', compact('page'));
    }

    public function edit(Course $course,Page $page)
    {

        return view('page.edit', compact('page', 'course'));
    }

    public function update(Course $course, Page $page)
    {

        $request = request();

        $data = $request->validate([
            'name' => 'required|max:255',
            'text' => 'required',
            'homework_condition' => 'sometimes',
            'answer' => 'sometimes',
            'youtube_link' => 'sometimes|url',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $str2 = $page->image;
            Storage::disk('public')->delete($str2);
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

    public function destroy(Course $course, Page $page)
    {
        $str2 = $page->image;
        Storage::disk('public')->delete($str2);
        $cid = $course->id;
        $pid = $page->id;
        $course_page = CoursePage::where(['course_id' => $cid, 'page_id' => $pid]);
        $course_page->delete();
        $page->delete();

        return redirect()->route('course.show', $course->id);

    }


}
