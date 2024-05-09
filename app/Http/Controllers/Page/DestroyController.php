<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\Page;
use App\Models\Tag;
use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DestroyController extends Controller
{

    public function __invoke(Course $course, Page $page)
    {
        $olddom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $olddom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' .$page->text);
        libxml_clear_errors();

        $oldimages = $olddom->getElementsByTagName('img');
        //Storage::disk('public')->delete('uploads/17152744000.png');
        foreach ($oldimages as $key => $img) {
            $imgSrc = $img->getAttribute('src');
            // Убедитесь, что путь к файлу относительно корневой директории public
            $imgPath = str_replace(url('/'), public_path(), $imgSrc);
            if(File::exists($imgPath))
            {
                // Удалите файл, используя путь относительно диска 'public'
                $publicPath = str_replace(url('/') . '/storage/', '', $imgSrc);
                Storage::disk('public')->delete($publicPath);
            }
        }

        $cid = $course->id;
        $pid = $page->id;
        $course_page = CoursePage::where(['course_id' => $cid, 'page_id' => $pid]);
        $course_page->delete();

        $related_records = CoursePage::where('page_id', $pid)->count();
        if ($related_records == 0) {
            $page->delete();
        }

        return redirect()->route('course.show', $course->id);

    }


}
