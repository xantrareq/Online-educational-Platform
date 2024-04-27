<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursePage;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    public function main()
    {
        //$courses = CourseController::all();
        $courses = Course::all();
        return view('course.courses', compact('courses'));
    }

    public function create()
    {
        return view('course.create');
    }

    public function edit(Course $course)
    {

        return view('course.edit', compact('course'));
    }

    public function update(Course $course)
    {
        $data = request()->validate([
            'title' => 'string',
            'descryption' => 'string',
            'teacher_id' => 'int',
        ]);
        //$data['descryption'] = nl2br($data['descryption']);

        $course->update($data);
        return redirect()->route('course.show', $course->id);
    }

    public function destroy(Course $course)
    {
        $course_pages = CoursePage::where(['course_id' => $course->id]);
        $cid = $course->id;
        $course_pages->each(function ($course_page) use ($cid){
            $pid = $course_page->page_id;
            $page =  Page::where(['id' => $pid]);
            $page->each(function ($p) {
                Storage::disk('public')->delete($p->image);
                $p->delete();
            });


            $course_page->delete();
        });


        $course->delete();

        return redirect()->route('course.main');

    }

    public function store()
    {

        $data = request()->validate([
            'title' => 'string',
            'descryption' => 'string',
            'teacher_id' => 'int',
        ]);
        //$data['descryption'] = $data['descryption'].replace("\n", "&lt");
        Course::create($data);
        return redirect()->route('course.main');
    }


    public function show(Course $course)
    {
//        dd($course->pages);
        return view('course.show', compact('course'));
    }

    public function page_show(Course $course, Page $page)
    {
        return view('page.show', compact('page', 'course'));
    }

    public function page_create(Course $course)
    {
//        dd(z);

        return view('page.create', compact('course'));
    }

    public function page_store(Course $course)
    {
        $request = request();

        $data = $request->validate([
            'name' => 'required|max:255',
            'text' => 'required',
            'homework_condition' => 'required',
            'answer' => 'required',
            'youtube_link' => 'required|url',
             // Проверка на наличие файла, что это изображение и максимальный размер файла
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

    public function register()
    {
        return view('register');

    }

    public function logging()
    {
        return view('logging');

    }

}
