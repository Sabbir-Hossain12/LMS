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
