<?php

use App\Http\Controllers\Frontend\Auth\StudentAuthController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

//Home 
Route::get('/',[HomeController::class,'homePage'])->name('home');


Route::view('/courses','Frontend.pages.course.courses');
Route::view('/course-details','Frontend.pages.course.course-details');

//Lessons

Route::view('/lessons','Frontend.pages.lesson.lesson');
Route::view('/lesson-course-material','Frontend.pages.course-material');
Route::view('/lesson-assignment','Frontend.pages.assignment');
Route::view('/lesson-quiz','Frontend.pages.lesson.quiz');


Route::view('/teachers','Frontend.pages.teacher.teachers');
Route::view('/teacher-details','Frontend.pages.teacher.teacher-details');

Route::view('/blog-details','Frontend.pages.blog.blog-details');

//Student Authentication
Route::prefix('student/login')->name('student.')->group(function ()
{
    Route::get('/phone', [StudentAuthController::class,'loginPhonePage'])->name('phone-page');
    Route::post('/phone/verify', [StudentAuthController::class,'verifyPhoneNumber'])->name('phone-verify');
    Route::get('/password', [StudentAuthController::class,'loginPasswordPage'])->name('password-page');
    Route::post('/password/verify', [StudentAuthController::class,'verifyPassword'])->name('password-verify');
    Route::get('/otp', [StudentAuthController::class,'loginOtpPage'])->name('otp-page');
    Route::post('/otp/verify', [StudentAuthController::class,'verifyOtp'])->name('otp-verify');
    Route::post('/otp/resend', [StudentAuthController::class,'resendOtp'])->name('otp-resend');
    Route::get('/register', [StudentAuthController::class,'registerPage'])->name('register-page');
    Route::post('/register/submit', [StudentAuthController::class,'register'])->name('register');
    Route::get('/forgot-password', [StudentAuthController::class,'forgotPage'])->name('forgot-page');
    Route::get('/reset-password', [StudentAuthController::class,'resetPage'])->name('reset-page');
    Route::post('/log-out', [StudentAuthController::class,'logOut'])->name('log-out');
    
});

//Student Dashboard
Route::prefix('student/dashboard')->middleware('role:student')->name('student.dashboard.')-> 
    group(function () {
        
    Route::get('/',[DashboardController::class,'index'])->name('index');
    Route::get('/courses',[DashboardController::class,'coursesPage'])->name('courses');
    Route::get('/assignments',[DashboardController::class,'assignmentsPage'])->name('assignments');
    Route::get('/exam-attempts',[DashboardController::class,'examAttemptsPage'])->name('exam-attempts');
    Route::get('/profiles',[DashboardController::class,'profilePage'])->name('profiles');
    Route::get('/reviews',[DashboardController::class,'reviewsPage'])->name('reviews');
    Route::get('/settings',[DashboardController::class,'settingsPage'])->name('settings');
    Route::get('/wishlists',[DashboardController::class,'wishlistPage'])->name('wishlists');
    
});



//Auth



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/admin.php';
//require __DIR__.'/auth.php';
