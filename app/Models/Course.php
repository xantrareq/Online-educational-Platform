<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    protected $table = 'courses'; //на всякий прописываем, что работаем именно с моделью Course
    use HasFactory;
    use SoftDeletes;//Мягкое удаление
    //Разрешает менять данные в таблице
    protected $guarded = [];
    //protected $fillable = []; - запрещает менять данные в таблице.

}
