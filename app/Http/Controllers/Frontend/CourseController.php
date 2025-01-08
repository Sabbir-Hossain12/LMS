<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function courseDetails(string $slug)
    {
        $courseDetails = Course::where('slug', $slug)->with('teacher', 'subjects', 'class', 'lessons',
            'lessons.lessonVideos', 'lessons.assessments')->first();

        $relatedCourses = Course::where('teacher_id', $courseDetails->teacher_id)->limit(4)->get();

        $popularCourses = Course::where('status', 1)->inRandomOrder()->limit(3)->get();
        $popularClasses = CourseClass::where('status', 1)->inRandomOrder()->limit(3)->get();

        $subjects = Subject::where('course_id', $courseDetails->id)->where('status', 1)->orderBy('position', 'asc')
            ->with([
                'lessons' => function ($q) {
                    $q->orderBy('position', 'asc');
                },
                'lessons.lessonVideos' => function ($q) {
                    $q->orderBy('position', 'asc');
                },

//                'lessons.assessments' => function ($q) {
//                    $q->orderBy('position', 'asc');
//                },


            ])->get();

        return view('Frontend.pages.course.course-details',
            compact('courseDetails', 'relatedCourses', 'popularCourses', 'popularClasses','subjects'));
    }

    public function courseLessons(string $slug)
    {
        $course = Course::where('slug', $slug)->first();

        $subjects = Subject::where('course_id', $course->id)->where('status', 1)->orderBy('position', 'asc')
            ->with([
                'lessons' => function ($q) {
                    $q->orderBy('position', 'asc');
                },
                'lessons.lessonVideos' => function ($q) {
                    $q->orderBy('position', 'asc');
                },
                
//                'lessons.assessments' => function ($q) {
//                    $q->orderBy('position', 'asc');
//                },


            ])->get();


//        $lessons=Lesson::where('course_id',$course->id)->with('lessonVideos',function ($q)
//        {
//            $q->orderBy('position','asc');
//            
//        })->get();

        return view('Frontend.pages.lesson.lesson', compact('course', 'subjects'));
    }

}
