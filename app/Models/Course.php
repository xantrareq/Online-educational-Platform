<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    protected $table = 'courses'; //на всякий прописываем, что работаем именно с моделью CourseController
    use HasFactory;
    use SoftDeletes;
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($course) {
            foreach ($course->pages as $page) {
                // Удалить изображение, если оно существует
                if (Storage::exists($page->image)) {
                    Storage::delete($page->image);
                }
            }

            $course->pages()->delete();
        });
    }
    //Мягкое удаление
    //Разрешает менять данные в таблице
    protected $guarded = [];

    //protected $fillable = []; - запрещает менять данные в таблице.

    public function pages()
    {
        return $this->belongsToMany(Page::class,'course_pages','course_id','page_id');
    }

}
