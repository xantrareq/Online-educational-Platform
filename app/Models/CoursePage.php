<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CoursePage extends Model
{
    use HasFactory;
    //Разрешает менять данные в таблице
    public $timestamps = false;

    protected $fillable = ['course_id', 'page_id'];

}
