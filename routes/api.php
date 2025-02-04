<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
Route::prefix('student/login')->name('api.auth.')->group(function () {
    Route::post('/phone/verify',
        [ApiController::class, 'verifyPhoneNumber'])->middleware('throttle:4,1')->name('phone-verify');
    Route::post('/password/verify', [ApiController::class, 'verifyPassword'])->name('password-verify');
    Route::post('/otp/verify', [ApiController::class, 'verifyOtp'])->name('otp-verify');
    Route::post('/otp/resend', [ApiController::class, 'resendOtp'])->name('otp-resend');
    Route::post('/register/submit', [ApiController::class, 'register'])->name('register');
    Route::post('/reset-password', [ApiController::class, 'resetPassword'])->name('reset-password');
    Route::post('/log-out', [ApiController::class, 'logOut'])->middleware('auth:sanctum')->name('log-out');
});


Route::name('api')->group(function () {
   
    Route::get('/basic-info', [ApiController::class, 'basicInfo'])->name('basicInfo');

    //Home Content
    Route::get('/home-banner-data',[ApiController::class,'homeBannerData'])->name('bannerData');
    Route::get('/home-category-data',[ApiController::class,'homeCategoryData'])->name('homeCategoryData');
    Route::get('/home-featured-course-data',[ApiController::class,'featuredCourseData'])->name('featuredCourseData');
    Route::get('/home-about-data',[ApiController::class,'homeAboutData'])->name('homeAboutData');
    Route::get('/home-popular-categories-data',[ApiController::class,'homePopularCategoriesData'])->name('bannerData');
    Route::get('/home-course-with-class-data',[ApiController::class,'homeCourseWithClass'])->name('homeCourseWithClass');
    Route::get('/home-teachers-data',[ApiController::class,'homeTeachersData'])->name('homeTeachersData');
    Route::get('/home-testimonial-data',[ApiController::class,'homeTestimonialData'])->name('homeTestimonialData');
    Route::get('/home-blogs-data',[ApiController::class,'homeBlogData'])->name('homeBlogData');
   
    
    //courses
    Route::get('/course-list',[ApiController::class,'courseList'])->name('courseList');
    Route::get('/course-details/{slug}',[ApiController::class,'courseDetails'])->name('courseDetails');
    Route::get('/check-enrollment/{id}',[ApiController::class,'checkEnrollment'])->name('checkEnrollment');
    //teachers
    Route::get('/teacher-list',[ApiController::class,'teacherList'])->name('teacherList');
    Route::get('/teacher-details/{slug}',[ApiController::class,'teacherDetails'])->name('teacherDetails');
    
    //Blogs
    Route::get('/blog-list',[ApiController::class,'blogList'])->name('blogList');
    Route::get('/blog-details/{slug}',[ApiController::class,'blogDetails'])->name('blogDetails');
    
    //footer content
    Route::get('/footer-useful-links',[ApiController::class,'footerUsefulLinks'])->name('footerUsefulLinks');
    Route::get('/footer-courses',[ApiController::class,'footerCourses'])->name('footerUsefulLinks');
    Route::get('/footer-recent-posts',[ApiController::class,'footerRecentPosts'])->name('footerUsefulLinks');
    
    //pages
    Route::get('/about-us-page',[ApiController::class,'aboutUsPage'])->name('aboutUsPage');
    
    //ChatGPT
    Route::post('/chat', [ApiController::class,'chat'])->name('chat');
});



