<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentGrade;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Question;
use App\Models\User;
use App\Models\QuizAttemptAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $student_id = auth()->user()->id;
        $student = User::where('id', $student_id)->first();
        $enrollments_count = Enrollment::where('user_id', $student_id)->with(['student', 'course'])->count();

        return view('Frontend.pages.dashboard.index', compact('enrollments_count', 'student'));
    }


    public function dashboardSummeryPage()
    {
        $student_id = auth()->user()->id;

        $enrollments_count = Enrollment::where('user_id', $student_id)->with(['student', 'course'])->count();
        $exam_count = AssessmentGrade::where('student_id', $student_id)->count();
        $course_count = Course::where('status', 1)->count();

        $dashSummeryPage = view('Frontend.pages.dashboard.include.summery',
            compact(['enrollments_count', 'exam_count', 'course_count']))->render();


        return response()->json(['html' => $dashSummeryPage]);
    }

    public function dashboardProfilePage()
    {
        $student_id = auth()->user()->id;

        $student = User::where('id', $student_id)->first();

        $ProfilePage = view('Frontend.pages.dashboard.include.profile', compact('student'))->render();


        return response()->json(['html' => $ProfilePage]);
    }


    public function dashboardCoursesPage()
    {
        $student_id = auth()->user()->id;

        $enrollments = Enrollment::where('user_id', $student_id)->with(['student', 'course'])->get();


        $CoursesPage = view('Frontend.pages.dashboard.include.courses', compact('enrollments'))->render();

        return response()->json(['html' => $CoursesPage]);
    }


    public function dashboardExamPage()
    {
        $student_id = auth()->user()->id;
        $enrollments = Enrollment::where('user_id', $student_id)->with(['student', 'course'])->get();

        $grades = AssessmentGrade::where('student_id', $student_id)->with('assessmentAnswer','assessment', 'assessment.course')->get();

        $ExamsPage = view('Frontend.pages.dashboard.include.exam-attempts', compact('enrollments', 'grades'))->render();

        return response()->json(['html' => $ExamsPage]);
    }


    public function dashboardSettingsPage()
    {
        $student_id = auth()->user()->id;

        $student = User::where('id', $student_id)->first();

        $SettingsPage = view('Frontend.pages.dashboard.include.settings', compact('student'))->render();

        return response()->json(['html' => $SettingsPage]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'email' => 'email',
            'address' => 'string',
        ]);

        $student_id = auth()->user()->id;
        $student = User::where('id', $student_id)->first();
        $student->name = $request->name;
        $student->slug = Str::slug($request->name).'-'.uniqid();
        $student->email = $request->email;
        $student->address = $request->address;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time().uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('backend/upload/student/'), $imageName);
            $student->profile_image = 'backend/upload/student/'.$imageName;
        }

        $save = $student->save();

        if (!$save) {
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Profile Updated successfully'], 200);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $student_id = auth()->user()->id;
        $student = User::where('id', $student_id)->first();

        if (!Hash::check($request->current_password, $student->password)) {
            return response()->json(['status' => 'failed', 'message' => 'Current password does not match'], 500);
        }


        $student->password = Hash::make($request->password);
        $save = $student->save();

        if (!$save) {
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Password Updated successfully'], 200);
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'fb_link' => 'string',
            'youtube_link' => 'string',
            'insta_link' => 'string',
            'twitter_link' => 'string',
        ]);

        $student_id = auth()->user()->id;
        $student = User::where('id', $student_id)->first();
        $student->fb_link = $request->fb_link;
        $student->youtube_link = $request->youtube_link;
        $student->insta_link = $request->insta_link;
        $student->twitter_link = $request->twitter_link;
        $save = $student->save();

        if (!$save) {
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Social Updated successfully'], 200);
    }


    public function examSolution(Request $request, string $id)
    {


        $examType = Assessment::where('id', $id)->first();
        
        // if ($examType->end_time >= now()) {

        //     return response()->json(['html' => '<div class="alert alert-danger">Please Wait till the exam ends</div>']);
        // }
        
        $questions = Question::where('assessment_id', $id)->where('status', 1)->get();
         $attempts= QuizAttemptAnswer::with('question')
            ->where('student_id', auth()->user()->id)->where('assessment_id', $id)->get();
        
        if ($examType->type == 'quiz') {
            $quizView = view('Frontend.pages.dashboard.include.quiz-solution', compact('attempts', 'examType'))->render();

            return response()->json(['html' => $quizView]);
        } else {
            if ($examType->type == 'assignment') {
                $assignmentView = view('Frontend.pages.dashboard.include.assignment-solution',
                    compact('questions', 'examType'))->render();

                return response()->json(['html' => $assignmentView]);
            }
        }

        return response()->json(['html' => '<div class="alert alert-danger">Material Not Found</div>']);

    }


}
