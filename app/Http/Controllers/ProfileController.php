<?php

namespace App\Http\Controllers;
use App\Models\Course;
class ProfileController extends Controller
{

    public function main()
    {
        return view('profile');
    }

}
