<?php


use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BasicinfoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HerobannerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\TestimonialSettingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


//Authentication

Route::prefix('admin')->name('admin.')->middleware('guest')->group(function () {
    
    Route::get('/login', [AuthenticationController::class, 'create']);
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login');
    
});


Route::prefix('admin')->name('admin.')->middleware(['role:admin|teacher'])->group(function ()
{
    
    Route::post('logout', [AuthenticationController::class, 'destroy'])->name('logout');
    
    Route::resource('/dashboards', DashboardController::class)->names('dashboard');
    Route::resource('/admins', AdminController::class)->names('admin');
    Route::resource('/teachers', TeacherController::class)->names('teacher');
    Route::resource('/students', StudentController::class)->names('student');
    
    
    Route::resource('/roles', RoleController::class)->names('role');
    Route::resource('/permissions', PermissionController::class)->names('permission');
    
    
    Route::resource('/herobanners', HerobannerController::class)->names('herobanner');
    
    Route::resource('/basic-infos', BasicinfoController::class)->names('basicinfo');
    
    Route::resource('/abouts', AboutController::class)->names('about');
    
    //testimonials
    Route::resource('/testimonials', TestimonialController::class)->names('testimonial');
    Route::get('//testimonial/data', [TestimonialController::class, 'getData'])->name('testimonials.data');
    Route::resource('/testimonial-settings', TestimonialSettingController::class)->names('testimonial-settings');
    
    Route::resource('/blogs', BlogController::class)->names('blog');
    
});