<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AssessmentGrade;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Frontend.pages.dashboard.index');
    }


    public function dashboardSummeryPage()
    {
        $student_id= auth()->user()->id;
        
        $enrollments = Enrollment::where('user_id', $student_id)->with(['student','course'])->get();
        
        $dashSummeryPage = view('Frontend.pages.dashboard.include.summery', compact('enrollments'))->render();
        
        
        return response()->json(['html' => $dashSummeryPage]);
    }

    public function dashboardProfilePage()
    {
        $student_id= auth()->user()->id;

        $student = User::where('id', $student_id)->first();

        $ProfilePage = view('Frontend.pages.dashboard.include.profile', compact('student'))->render();


        return response()->json(['html' => $ProfilePage]);
        
    }


    public function dashboardCoursesPage()
    {
        $student_id= auth()->user()->id;

        $enrollments = Enrollment::where('user_id', $student_id)->with(['student','course'])->get();
        
        $CoursesPage = view('Frontend.pages.dashboard.include.courses', compact('enrollments'))->render();

        return response()->json(['html' => $CoursesPage]);
    }
    
    
    public function dashboardExamPage()
    {
        $student_id= auth()->user()->id;
        $enrollments = Enrollment::where('user_id', $student_id)->with(['student','course'])->get();

//        $grades = AssessmentGrade::whereHas('assessment', function ($query) use ($enrollments) {
//            $query->where('course_id', $enrollments->course_id);
//        })->with('assessment')->latest()->get();
        
        
        
        $ExamsPage = view('Frontend.pages.dashboard.include.exam-attempts', compact('enrollments'))->render();
        
        return response()->json(['html' => $ExamsPage]);
            
       
        
    }
    
    
 
    
    public function dashboardSettingsPage()
    {

        $student_id= auth()->user()->id;

        $student = User::where('id', $student_id)->first();

        $SettingsPage = view('Frontend.pages.dashboard.include.settings', compact('student'))->render();

        return response()->json(['html' => $SettingsPage]);
        
    }


}
