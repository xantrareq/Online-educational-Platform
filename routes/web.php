<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomePage;
Route::get('/', [App\Http\Controllers\WelcomePage::class,'main'])->name('welcome_page');

Route::get('/about_us', [App\Http\Controllers\AboutPage::class,'main'])->name('about_us.main');
Route::get('/my_profile', [App\Http\Controllers\ProfileController::class,'main'])->name('my_profile.main');


Route::get('/courses/list', [App\Http\Controllers\CourseController::class,'main'])->name('course.main');
Route::get('/courses/create', [App\Http\Controllers\CourseController::class,'create'])->name('course.create');
Route::post('/courses/store', [App\Http\Controllers\CourseController::class,'store'])->name('course.store');
Route::get('/courses/{course}', [App\Http\Controllers\CourseController::class,'show'])->name('course.show');


Route::get('/delete', [WelcomePage::class,'delete']);


