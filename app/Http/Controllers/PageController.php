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

    public function edit(Page $page)
    {

        return view('page.edit', compact('page'));
    }

    public function update(Course $course, Page $page)
    {
        $data = request()->only('name', 'text');
        $request = request();
        $path = "";
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');

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
