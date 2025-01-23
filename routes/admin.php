<?php


use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AssessmentAnswerController;
use App\Http\Controllers\Admin\AssessmentController;
use App\Http\Controllers\Admin\AssessmentGradeController;
use App\Http\Controllers\Admin\BasicinfoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrolmentController;
use App\Http\Controllers\Admin\HerobannerController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LessonMaterialController;
use App\Http\Controllers\Admin\LessonVideoController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TestimonialController;

use App\Http\Controllers\Admin\Auth\AuthenticationController;
use App\Http\Controllers\Admin\TestimonialSettingController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Artisan;
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
    
    //Courses
    Route::resource('/courses', CourseController::class)->names('course');
    Route::get('/course/data', [CourseController::class, 'getData'])->name('course.data');
    Route::post('/course/change-status', [CourseController::class, 'changeCourseStatus'])->name('course.status');
    Route::post('/course/change-featured-status', [CourseController::class, 'changeFeaturedCourseStatus'])->name('course.featured-status');
    
    //Subject
    Route::get('/subjects/{id}', [SubjectController::class, 'index'])->name('subject');
    Route::post('/subjects/store', [SubjectController::class, 'store'])->name('subject.store');
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
    
    //Lesson
    Route::get('/lessons/{id}', [LessonController::class, 'index'])->name('lesson');
    Route::post('/lessons/store', [LessonController::class, 'store'])->name('lesson.store');
    Route::delete('/lessons/{id}', [LessonController::class, 'destroyLesson'])->name('lesson.destroy');
    
    
    //Lesson Video
    Route::get('/lesson-videos/{id}', [LessonVideoController::class, 'index'])->name('lesson-video');
    Route::post('/lesson-videos/store', [LessonVideoController::class, 'store'])->name('lesson-video.store');
    Route::delete('/lesson-videos/{id}', [LessonVideoController::class, 'destroyLessonVideo'])->name('lesson-video.destroy');
    
    //Lesson Materials
    Route::get('/lesson-materials/{id}', [LessonMaterialController::class, 'index'])->name('lesson-material');
    Route::post('/lesson-materials/store', [LessonMaterialController::class, 'store'])->name('lesson-material.store');
    Route::delete('/lesson-materials/{id}', [LessonMaterialController::class, 'destroyLessonMaterial'])->name('lesson-material.destroy');
    
    //Lesson Assessment
    Route::get('/lesson-assessments/{id}', [AssessmentController::class, 'index'])->name('lesson-assessment');
    Route::post('/lesson-assessments/store', [AssessmentController::class, 'store'])->name('lesson-assessment.store');
    Route::delete('/lesson-assessments/{id}', [AssessmentController::class, 'destroyLessonAssessment'])->name('lesson-assessment.destroy');
    

    //Assessment Questions
    Route::get('/assessment-questions/{id}', [QuestionController::class, 'index'])->name('assessment-question');
    Route::post('/assessment-questions/store', [QuestionController::class, 'store'])->name('assessment-question.store');
    Route::delete('/assessment-questions/{id}', [QuestionController::class, 'destroyAssessmentQuestion'])->name('assessment-question.destroy');

    //Assessment Answer 
    Route::get('/lesson-assessment-answers/{id}', [AssessmentAnswerController::class, 'index'])->name('assessment-answer');
    Route::post('/assessment-mark-evaluation/store', [AssessmentGradeController::class, 'markEvaluation'])->name('assessment-mark-evaluate.store');


    //Enrolment
    Route::get('/enrolments/{id}', [EnrolmentController::class, 'index'])->name('enrolment');
    Route::post('/enrolments/store', [EnrolmentController::class, 'store'])->name('enrolment.store');
    Route::delete('/enrolments/{id}', [EnrolmentController::class, 'destroyEnrolment'])->name('enrolment.destroy');
    
    Route::get('/enroll-student-view/{id}/{course_id}', [EnrolmentController::class, 'viewEnrollStudent'])->name('enroll-student.view');
    
    //Orders
    Route::resource('/orders', OrderController::class)->names('order');
    Route::get('/order/data', [OrderController::class, 'getData'])->name('order.data');
    Route::post('/change-order-status', [OrderController::class, 'changeAdminStatus'])->name('order.status');
    
    //Hero Banners
    Route::resource('/herobanners', HerobannerController::class)->names('herobanner');
    
    //basic settings
    Route::resource('/basic-infos', BasicinfoController::class)->names('basicinfo');
    
    //about Sections
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