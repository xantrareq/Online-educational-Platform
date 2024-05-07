<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Page;

class Post extends Controller
{

    public function __invoke()
    {

        return view('adminpanel.course');
    }
}
