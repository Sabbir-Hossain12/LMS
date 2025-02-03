<?php

use App\Http\Controllers\Frontend\AiController;
use App\Http\Controllers\Frontend\Auth\StudentAuthController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\TeacherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/site-down',function ()
{
    Artisan::call('down');

    return 'The site is now in maintenance mode.';
    
});

Route::get('/site-up',function ()
{
    Artisan::call('up');

    return 'The site is now live.';
});




//Home 
Route::get('/',[HomeController::class,'homePage'])->name('home');

//Search Results (courses)
Route::get('/search-results', [CourseController::class,'searchResults'])->name('search-results');
//Courses
Route::get('/course-list', [CourseController::class,'courseList'])->name('course-list');
Route::get('/course-details/{slug}', [CourseController::class,'courseDetails'])->name('course-details');
Route::get('/course-by-class/{slug}', [CourseController::class,'coursesByClass'])->name('course-by-class');
//Class
Route::get('/class-list', [CourseController::class,'classList'])->name('class-list');

//Lessons
Route::get('/course-lessons/{slug}', [CourseController::class,'courseLessons'])->name('course-lessons');
Route::post('/course-lessons/video',[CourseController::class,'courseLessonsVideo'])->name('lesson-video');
Route::post('/course-lessons/material',[CourseController::class,'courseLessonsMaterial'])->name('lesson-material');
Route::post('/course-lessons/Exam',[CourseController::class,'courseLessonsExam'])->name('lesson-exam');

//Exam Submit
Route::post('/assignment-submit',[CourseController::class,'assignmentSubmit'])->name('assignment.submit');
Route::post('/quiz-submit',[CourseController::class,'quizSubmit'])->name('quiz.submit');

//Teacher Details
Route::get('/teachers',[TeacherController::class,'teachersPage'])->name('teacher.page');
Route::get('/teacher_details/{slug}',[TeacherController::class,'teachersDetails'])->name('teacher.details');


//Blogs
Route::get('/blog-list', [BlogController::class,'blogList'])->name('blog-list');
Route::get('/blog_details/{slug}',[BlogController::class,'blogDetails'])->name('blog-details');

//Checkout and Orders
Route::get('/checkout/{slug}', [OrderController::class,'checkoutPage'])->middleware(\App\Http\Middleware\StudentMiddleware::class)->name('checkout');
Route::post('/order/submit', [OrderController::class,'orderSubmit'])->middleware(\App\Http\Middleware\StudentMiddleware::class)->name('order.submit');

//pages
Route::prefix('pages')->group(function () {
    
    Route::get('/{slug}', [HomeController::class,'page'])->name('page');
});

//ChatGPT
Route::get('/ai-assistant', [AiController::class,'aiAssistant'])->name('ai-assistant');

Route::post('/chat',AiController::class)->name('chat');


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
    Route::get('/forgot-password-page', [StudentAuthController::class,'forgotPage'])->name('forgot-page');
    Route::get('/reset-page', [StudentAuthController::class,'resetPage'])->name('reset-page');
    Route::post('/reset-password', [StudentAuthController::class,'resetPassword'])->name('reset-password');
    Route::post('/log-out', [StudentAuthController::class,'logOut'])->name('log-out');
    
});

//Student Dashboard
Route::prefix('student/dashboard')->middleware('role:student')->name('student.dashboard.')-> 
    group(function () {
        
    Route::get('/',[DashboardController::class,'index'])->name('index');
    Route::get('/dashboard-summery', [DashboardController::class,'dashboardSummeryPage'])->name('summery');
    Route::get('/dashboard-courses',[DashboardController::class,'dashboardCoursesPage'])->name('courses');
    Route::get('/dashboard-exam-attempts',[DashboardController::class,'dashboardExamPage'])->name('exam');
    Route::get('/dashboard-exam-solutions/{id}',[DashboardController::class,'examSolution'])->name('exam.solution');
    Route::get('/dashboard-profiles',[DashboardController::class,'dashboardProfilePage'])->name('profile');
    Route::get('/dashboard-settings',[DashboardController::class,'dashboardSettingsPage'])->name('setting');
    
    Route::post('/update-profile', [DashboardController::class,'updateProfile'])->name('profile.update');
    Route::post('/update-password', [DashboardController::class,'updatePassword'])->name('profile.password');
    Route::post('/update-social-links', [DashboardController::class,'updateSocial'])->name('profile.social');
    
});


//Bkash

    // Payment Routes for bKash
    Route::get('/bkash/payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'index']);
    Route::get('/bkash/create-payment', [App\Http\Controllers\BkashTokenizePaymentController::class,'createPayment'])->name('bkash-create-payment');
    Route::get('/bkash/callback', [App\Http\Controllers\BkashTokenizePaymentController::class,'callBack'])->name('bkash-callBack');

    //search payment
    Route::get('/bkash/search/{trxID}', [App\Http\Controllers\BkashTokenizePaymentController::class,'searchTnx'])->name('bkash-serach');

    //refund payment routes
    Route::get('/bkash/refund', [App\Http\Controllers\BkashTokenizePaymentController::class,'refund'])->name('bkash-refund');
    Route::get('/bkash/refund/status', [App\Http\Controllers\BkashTokenizePaymentController::class,'refundStatus'])->name('bkash-refund-status');
    

require __DIR__.'/admin.php';
//require __DIR__.'/auth.php';
