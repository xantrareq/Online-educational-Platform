<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomePage;
Route::get('/', [App\Http\Controllers\WelcomePage::class,'main'])->name('welcome_page');

Route::get('/about_us', [App\Http\Controllers\AboutPage::class,'main'])->name('about_us.main');
Route::get('/courses_list', [App\Http\Controllers\CoursesListPage::class,'main'])->name('course_list.main');
Route::get('/my_profile', [App\Http\Controllers\ProfilePage::class,'main'])->name('my_profile.main');

Route::get('/create', [WelcomePage::class,'create'])->name('course_create.main');;

Route::get('/delete', [WelcomePage::class,'delete']);


