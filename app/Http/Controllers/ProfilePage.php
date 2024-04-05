<?php

namespace App\Http\Controllers;
use App\Models\Course;
class ProfilePage extends Controller
{

    public function main()
    {
        return view('profile');
    }

}
