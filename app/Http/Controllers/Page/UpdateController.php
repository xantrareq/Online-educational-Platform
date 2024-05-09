<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePage;
use App\Models\CourseTag;
use App\Models\CourseUser;
use App\Models\LikedCourse;
use App\Models\Page;
use App\Models\PageUser;
use App\Models\Tag;
use App\Models\User;
use DOMDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UpdateController extends Controller
{

    public function __invoke(Course $course, Page $page)
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $dom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . request()->text);
        libxml_clear_errors();

        $olddom = new DOMDocument('1.0', 'UTF-8');
        libxml_use_internal_errors(true);
        $olddom->loadHTML('<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $page->text);
        libxml_clear_errors();

        $oldimages = $olddom->getElementsByTagName('img');
        //Storage::disk('public')->delete('uploads/17152744000.png');
        foreach ($oldimages as $key => $img) {
            $imgSrc = $img->getAttribute('src');
            // Убедитесь, что путь к файлу относительно корневой директории public
            $imgPath = str_replace(url('/'), public_path(), $imgSrc);
            if (File::exists($imgPath)) {
                // Удалите файл, используя путь относительно диска 'public'
                $publicPath = str_replace(url('/') . '/storage/', '', $imgSrc);
                Storage::disk('public')->delete($publicPath);
            }
        }


        $request = request();
        $request->validate([
            'name' => 'string|max:255',
            'text' => '',
            'homework_condition' => 'sometimes|max:1200',
            'answer' => 'sometimes|required_with:points|max:100',
            'points' => 'sometimes|required_with:answer|max:10',
            'trys' => 'nullable|integer|max:50',
        ]);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            // Определите максимальный размер изображения в байтах.
            $maxSize = 102400000; // 500KB

            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                // Проверьте размер изображения.
                if (strlen($data) > $maxSize) {
                    echo "Изображение слишком большое.";

                }

                $image_name = "/uploads/" . time() . $key . '.png';
                Storage::disk('public')->put($image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', asset('storage' . $image_name));
            }
        }
        // Удалите старые изображения, которых больше нет на странице.


        $description = $dom->saveHTML();
        $data = (['name' => $request->name,
            'text' => $description,
            'homework_condition' => $request->homework_condition,
            'answer' => $request->answer,
            'points' => $request->points,
            'trys' => $request->trys,
        ]);

        $page->update($data);

        $userIds = CourseUser::where('course_id', $course->id)->pluck('user_id');
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            $user_id = $user->id;
            $pages = $course->pages()->get();
            foreach ($pages as $page) {
                $pu = PageUser::where(['user_id' => $user_id, 'page_id' => $page->id])->first();

                if ($pu === null) {
                    PageUser::create(['user_id' => $user_id, 'page_id' => $page->id, 'trys' => $page->trys]);
                }
                else
                    $pu->update(['user_id' => $user_id, 'page_id' => $page->id, 'trys' => $page->trys]);

            }

        }

        return redirect()->route('course_page.show', [$course->id, $page->id]);
    }


}
