<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    protected $table = 'pages'; //на всякий прописываем, что работаем именно с моделью CourseController
    use HasFactory;
    public $timestamps = false;

    protected $guarded = [];
    //protected $fillable = []; - запрещает менять данные в таблице.
}
