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
Route::get('/courses/{course}/edit', [App\Http\Controllers\CourseController::class,'edit'])->name('course.edit');
Route::patch('/courses/{course}', [App\Http\Controllers\CourseController::class,'update'])->name('course.update');
Route::delete('/courses/{course}', [App\Http\Controllers\CourseController::class,'destroy'])->name('course.destroy');


Route::get('/courses/{course}/create/page', [App\Http\Controllers\CourseController::class,'page_create'])->name('page.create');
Route::post('/courses/{course}/page_store', [App\Http\Controllers\CourseController::class,'page_store'])->name('page.store');
Route::get('/courses/{course}/{page}', [App\Http\Controllers\CourseController::class,'page_show'])->name('course_page.show');
Route::get('/courses/{course}/{page}/edit', [App\Http\Controllers\PageController::class,'edit'])->name('page.edit');
Route::patch('/courses/{course}/{page}/update', [App\Http\Controllers\PageController::class,'update'])->name('page.update');
Route::delete('/courses/{course}/{page}/destroy', [App\Http\Controllers\PageController::class,'destroy'])->name('page.destroy');

Route::get('/register', [App\Http\Controllers\CourseController::class,'register'])->name('register');
Route::get('/logging', [App\Http\Controllers\CourseController::class,'logging'])->name('logging');




