<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teachersPage()
    {
        $teachers= User::role('teacher')->where('status',1)->get();
        
        return view('Frontend.pages.teacher.teachers',compact('teachers'));
    }

    public function teachersDetails(string $slug)
    {
        
      $teacher=  User::where('slug', $slug)->firstOrFail();
      
      $relatedCourses= Course::where('teacher_id', $teacher->id)->where('status',1)->limit(4)->get();
      return view('Frontend.pages.teacher.teacher-details',compact('teacher','relatedCourses'));
      
    }
}
