<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    public function main()
    {
        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'teacher_id' => 'int',
            'tags' => '',
        ]);

        $query = Course::query();
        if (isset($data['teacher_id'])){
            $query->where('teacher_id', $data['teacher_id'])->get();

        }
        if (isset($data['title'])) {
            $query->where('title','like', "%{$data['title']}%");
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
        return view('course.courses', compact('courses','tags'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('course.create',compact('tags'));
    }

    public function store()
    {

        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'teacher_id' => 'int',
            'tags'=>'',
        ]);
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        $course = Course::create($data);
        if (isset($tags)) {
            $course->tags()->attach($tags);
        }

//        foreach ($tags as $tag) {
//            CourseTag::firstOrCreate([
//                'tag_id'=>$tag,
//                'course_id'=>$course->id,
//            ]);
//        }

        return redirect()->route('course.main');
    }

    public function edit(Course $course)
    {
        $tags = Tag::all();

        return view('course.edit', compact('course','tags'));
    }

    public function update(Course $course)
    {
        $data = request()->validate([
            'title' => 'string',
            'description' => 'string',
            'teacher_id' => 'int',
            'tags' => '',
        ]);
        if (isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }

        $course->update($data);
        if (isset($tags)){
            $course->tags()->sync($tags);
        }
        else{
            $course->tags()->detach();
        }
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




    public function show(Course $course)
    {
        $pages = $course->pages()->paginate(7); // 10 - количество страниц на одной странице пагинации
        return view('course.show', compact('course','pages'));
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
            'homework_condition' => 'sometimes',
            'answer' => 'sometimes',
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

    public function register()
    {
        return view('register');

    }

    public function logging()
    {
        return view('logging');

    }

}
