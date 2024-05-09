<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseUser extends Model
{
    use HasFactory;
    public $timestamps = false;

    //Мягкое удаление
    //Разрешает менять данные в таблице
    protected $guarded = [];
}
