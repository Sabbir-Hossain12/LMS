<?php


use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BasicinfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HerobannerController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    
    Route::resource('/dashboards', DashboardController::class);
    Route::resource('/admins', AdminController::class);
    Route::resource('/teachers', TeacherController::class);
    Route::resource('/students', StudentController::class);
    
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    
    
    
    Route::resource('/basic-infos', BasicinfoController::class);
    Route::resource('/abouts', AboutController::class);
    Route::resource('/herobanners', HerobannerController::class);
    Route::resource('/testimonials', TestimonialController::class);
   
    
});