<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'App\Http\Controllers\Course'], function () {
    Route::get('/courses/list', 'ListController')->name('course.main');
    Route::get('/courses/{course}', 'ShowController')->name('course.show');
});


Route::group(['namespace'=>'App\Http\Controllers\Course','middleware' => 'AuthCheck'], function () {
    Route::get('/course/create', 'CreateController')->name('course.create');
    Route::get('/courses/{course}/like', 'LikeCourseController')->name('course.like');
    Route::get('/courses/{course}/unlike', 'UnLikeCourseController')->name('course.unlike');
    Route::get('/liked', 'ShowLikedController')->name('course.ShowLiked');
    Route::post('/course/store', 'StoreController')->name('course.store');
    Route::get('/my_courses', 'MyCoursesController')->name('course.my_courses');
});


Route::group(['namespace'=>'App\Http\Controllers\Course','middleware' => 'checkCourseUser'], function () {
    Route::get('/courses/{course}/edit', 'EditController')->name('course.edit');
    Route::get('/courses/{course}/students', 'StudentsController')->name('course.students');
    Route::patch('/courses/{course}', 'UpdateController')->name('course.update');
    Route::delete('/courses/{course}', 'DestroyController')->name('course.destroy');
});


Route::group(['namespace'=>'App\Http\Controllers\Page','middleware' => 'Liked'], function () {
    Route::get('/courses/{course}/{page}', 'ShowController')->name('course_page.show');
});

Route::group(['namespace'=>'App\Http\Controllers\Page','middleware' => 'checkCourseUser'], function () {
    Route::get('/courses/{course}/create/page', 'CreateController')->name('page.create');
    Route::post('/courses/{course}/page_store', 'StoreController')->name('page.store');
    Route::get('/courses/{course}/{page}/edit', 'EditController')->name('page.edit');
    Route::patch('/courses/{course}/{page}/update', 'UpdateController')->name('page.update');
    Route::delete('/courses/{course}/{page}/destroy', 'DestroyController')->name('page.destroy');
});
Route::group(['namespace'=>'App\Http\Controllers\Page','middleware' => 'Liked'], function () {
    Route::post('/{course}/{page}/answer', 'AnswerController')->name('page.answer');
});




Route::get('/', [App\Http\Controllers\WelcomePage::class,'main'])->name('welcome_page');

Route::group(['namespace'=>'App\Http\Controllers\Admin','middleware' => 'admin'], function () {
    Route::get('/admin/course', 'Post')->name('admin_panel');

});


Route::get('/about_us', [App\Http\Controllers\AboutPage::class,'main'])->name('about_us.main');
Route::get('/my_profile', [App\Http\Controllers\ProfileController::class,'main'])->name('my_profile.main');






//Route::get('/register', [App\Http\Controllers\CourseController::class,'register'])->name('register');
//Route::get('/logging', [App\Http\Controllers\CourseController::class,'logging'])->name('logging');





Auth::routes();

Route::group(['namespace'=>'App\Http\Controllers\Auth','middleware' => 'AuthCheck'], function () {
    Route::post('changepass/{user}', 'ChangePass')->name('auth.changepass');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/pass_changed', [App\Http\Controllers\HomeController::class, 'passchanged'])->name('pass_changed');

});
