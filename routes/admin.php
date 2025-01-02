<?php


use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BasicinfoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HerobannerController;
use App\Http\Controllers\Admin\PageController;
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
    
    Route::get('/login', [AuthenticationController::class, 'create'])->name('login-view');
    Route::post('/login', [AuthenticationController::class, 'store'])->name('login');
    
});


Route::prefix('admin')->name('admin.')->middleware(['checkAuth','role:admin|teacher'])->group(function ()
{
    
    Route::post('logout', [AuthenticationController::class, 'destroy'])->name('logout');
    
    Route::resource('/dashboards', DashboardController::class)->names('dashboard');
    
    //Admin
    Route::resource('/admins', AdminController::class)->names('admin');
    Route::get('/admin/data', [AdminController::class, 'getData'])->name('admin.data');
    Route::post('/change-admin-status', [AdminController::class, 'changeAdminStatus'])->name('admin.status');
    
    //Teacher
    Route::resource('/teachers', TeacherController::class)->names('teacher');
    Route::get('/teacher/data', [TeacherController::class, 'getData'])->name('teacher.data');
    Route::post('/change-teacher-status', [TeacherController::class, 'changeTeacherStatus'])->name('teacher.status');

    //Student
    Route::resource('/students', StudentController::class)->names('student');
    Route::get('/student/data', [StudentController::class, 'getData'])->name('student.data');
    Route::post('/change-student-status', [StudentController::class, 'changeStudentStatus'])->name('student.status');
    
    //Roles and Permissions
    Route::resource('/roles', RoleController::class)->names('role');
    Route::get('/role/data', [RoleController::class, 'getData'])->name('role.data');
    Route::get('/assign-permission-page/{id}', [RoleController::class, 'assignPermissionsToRolePage'])->name('role.assign-permissions-page');
    Route::put('role/{id}/permission/update', [RoleController::class, 'assignPermissionsToRole'])->name('role.assign-permission-update');
    
    Route::resource('/permissions', PermissionController::class)->names('permission');
    Route::get('/permission/data', [PermissionController::class, 'getData'])->name('permission.data');
    
    //Class
    Route::resource('/classes', ClassController::class)->names('class');
    Route::get('/class/data', [ClassController::class, 'getData'])->name('class.data');
    Route::post('/class/change-status', [ClassController::class, 'changeClassStatus'])->name('class.status');
    Route::post('/class/change-featured-status', [ClassController::class, 'changeFeaturedClassStatus'])->name('class.featured-status');
    
    
    Route::resource('/herobanners', HerobannerController::class)->names('herobanner');
    
    Route::resource('/basic-infos', BasicinfoController::class)->names('basicinfo');
    
    Route::resource('/abouts', AboutController::class)->names('about');
    
    
    //testimonials
    Route::resource('/testimonials', TestimonialController::class)->names('testimonial');
    Route::get('/testimonial/data', [TestimonialController::class, 'getData'])->name('testimonials.data');
    Route::post('/testimonial/change-status', [TestimonialController::class, 'changeStatus'])->name('testimonials.change-status');
    Route::resource('/testimonial-settings', TestimonialSettingController::class)->names('testimonial-settings');
    
    
    //Blogs
    Route::resource('/blogs', BlogController::class)->names('blog');
    Route::get('/blog/data', [BlogController::class, 'getData'])->name('blog.data');
    Route::post('/blog/change-status', [BlogController::class, 'changeStatus'])->name('blog.change-status');
    Route::post('/upload-ckeditor-image', [BlogController::class, 'uploadCkeditorImage'])->name('blog.ckeditor.upload');
    
    
    //pages
    Route::resource('/pages', PageController::class)->names('page');
});