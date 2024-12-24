<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::view('/','Frontend.pages.home');
Route::view('/courses','Frontend.pages.course.courses');
Route::view('/course-details','Frontend.pages.course.course-details');

//Lessons

Route::view('/lessons','Frontend.pages.lesson.lesson');
Route::view('/lesson-course-material','Frontend.pages.course-material');
Route::view('/lesson-assignment','Frontend.pages.assignment');
Route::view('/lesson-quiz','Frontend.pages.lesson.quiz');


Route::view('/teachers','Frontend.pages.teacher.teachers');
Route::view('/teacher-details','Frontend.pages.teacher.teacher-details');


//Student Dashboard

Route::prefix('student')->group(function ()
{
    
Route::view('/dashboards','Frontend.pages.student-dashboard.dashboard');
Route::view('/courses','Frontend.pages.student-dashboard.courses');
Route::view('/assignments','Frontend.pages.student-dashboard.assignments');
Route::view('/exam-attempts','Frontend.pages.student-dashboard.exam-attempts');
Route::view('/profiles','Frontend.pages.student-dashboard.profile');
Route::view('/reviews','Frontend.pages.student-dashboard.reviews');
Route::view('/settings','Frontend.pages.student-dashboard.settings');
Route::view('/wishlists','Frontend.pages.student-dashboard.wishlist');
    
});

//Auth

Route::view('/login','Frontend.auth.login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
