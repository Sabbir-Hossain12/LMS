<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentAnswer;
use App\Models\AssessmentGrade;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Enrollment;
use App\Models\Lesson;
use App\Models\LessonMaterial;
use App\Models\LessonVideo;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function courseDetails(string $slug)
    {
        $courseDetails = Course::where('slug', $slug)->with('teacher', 'subjects', 'class', 'lessons',
            'lessons.lessonVideos', 'lessons.assessments')->first();

        $enrollment = Enrollment::where('user_id', auth()->user()->id ?? 0)->where('course_id',
            $courseDetails->id)->first();

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
            compact('courseDetails', 'relatedCourses', 'popularCourses', 'popularClasses', 'subjects', 'enrollment'));
    }

    public function courseLessons(string $slug)
    {
        $course = Course::where('slug', $slug)->first();

        $enrollment = Enrollment::where('user_id', auth()->user()->id ?? 0)->where('course_id',
            $course->id)->first() ?? 0;


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

        return view('Frontend.pages.lesson.lesson', compact('course', 'subjects', 'enrollment'));
    }


    public function courseList()
    {
        $courses = Course::where('status', 1)->get();

        return view('Frontend.pages.course.course-list', compact('courses'));
    }

    public function ClassList()
    {
        $classes = CourseClass::where('status', 1)->get();
        return view('Frontend.pages.course.class-list', compact('classes'));
    }


    public function coursesByClass(string $slug)
    {
        $class = CourseClass::where('slug', $slug)->first();

        $courses = Course::where('course_class_id', $class->id)->where('status', 1)->get();

        return view('Frontend.pages.course.courses-by-class', compact('class', 'courses'));
    }


    public function courseLessonsVideo(Request $request)
    {
        $id = $request->input('id');
        $lesson_id = $request->input('lesson_id');

        $video = LessonVideo::where('id', $id)->where('lesson_id', $lesson_id)->first();


        $lessonVideoView = view('Frontend.pages.lesson.include.video', compact('video'))->render();


        if (!$video) {
            return response()->json(['html' => '<div class="alert alert-danger">Video Not Found</div>']);
        }

        return response()->json(['html' => $lessonVideoView]);
    }


    public function courseLessonsMaterial(Request $request)
    {
        $id = $request->id;
        $lesson_id = $request->lesson_id;

        $material = LessonMaterial::where('id', $id)->where('lesson_id', $lesson_id)->first();

        $lessonMaterialView = view('Frontend.pages.lesson.include.material', compact('material'))->render();


        if (!$material) {
            return response()->json(['html' => '<div class="alert alert-danger">Material Not Found</div>']);
        }

        return response()->json(['html' => $lessonMaterialView]);
    }


    public function courseLessonsExam(Request $request)
    {
        $assessment_id = $request->assessment_id;

        $questions = Question::where('assessment_id', $assessment_id)->where('status', 1)->get();

        $examType = Assessment::where('id', $assessment_id)->first();


        if ($examType->type == 'quiz') {
            $quizView = view('Frontend.pages.lesson.include.quiz', compact('questions', 'examType'))->render();

            return response()->json(['html' => $quizView]);
        } else {
            if ($examType->type == 'assignment') {
                $assignmentView = view('Frontend.pages.lesson.include.assignment',
                    compact('questions', 'examType'))->render();

                return response()->json(['html' => $assignmentView]);
            }
        }

        return response()->json(['html' => '<div class="alert alert-danger">Material Not Found</div>']);
    }


    public function assignmentSubmit(Request $request)
    {
        $request->validate(
            [
                'assessment_id' => ['required'],
                'file_path' => ['required', 'mimes:pdf,doc,docx'],
            ]
        );

        $assessment_id = $request->assessment_id;
        $student_id = auth()->user()->id;

        $assessment = Assessment::where('id', $assessment_id)->first();

        if (now() < $assessment->start_time || now() > $assessment->end_time) {
            return response()->json(['status' => 'failed', 'message' => 'Exam Not available now'], 500);
        }

        $exist = AssessmentAnswer::where('assessment_id', $assessment_id)->where('student_id', $student_id)->first();

        if ($exist) {
            if ($request->hasFile('file_path')) {
                if ($exist->file_path && file_exists(public_path($exist->file_path))) {
                    unlink(public_path($exist->file_path));
                }

                $file = $request->file('file_path');
                $fileName = time().uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('backend/upload/assignments/'), $fileName);
                $exist->file_path = 'backend/upload/assignments/'.$fileName;
            }
            $exist->attempts = $exist->attempts + 1;
            $exist->submitted_at = now();
            $exist->status=0;

            $save = $exist->save();
        } else {
            $assessmentAnswer = new AssessmentAnswer();
            $assessmentAnswer->assessment_id = $assessment_id;
            $assessmentAnswer->student_id = $student_id;

            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');
                $fileName = time().uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('backend/upload/assignments/'), $fileName);
                $assessmentAnswer->file_path = 'backend/upload/assignments/'.$fileName;
            }

            $assessmentAnswer->submitted_at = now();
            $assessmentAnswer->status=0;
            $save = $assessmentAnswer->save();
        }


        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Your Response Submitted successfully'], 201);
        }

        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
    }


    public function quizSubmit(Request $request)
    {
        $request->validate([
            'assessment_id' => ['required'],

        ]);

        $assessment_id = $request->assessment_id;
        $student_id = auth()->user()->id;
        $assessment = Assessment::where('id', $assessment_id)->first();

        if (now() < $assessment->start_time || now() > $assessment->end_time) {
            return response()->json(['status' => 'failed', 'message' => 'Exam Not available now'], 500);
        }

        $answers = $request->except(['assessment_id', '_token']);
        $marks_obtained = 0;
        foreach ($answers as $key => $answer) {
            $questionId = str_replace('answer_', '', $key);
            $question = Question::where('id', $questionId)->first();

            if ($question->correct_answers == $answer) {
                $marks_obtained = $marks_obtained + $question->marks;
            }
        }

        $exist = AssessmentGrade::where('assessment_id', $assessment_id)->where('student_id', $student_id)->first();
        $attempts=0;
        if ($exist) {
            $exist->marks_obtained = $marks_obtained;
            $exist->attempts = $exist->attempts+1;
            $exist->submitted_at = now();
            $save = $exist->save();
            
        } else {
            $assessmentGrade = new AssessmentGrade();
            $assessmentGrade->assessment_id = $assessment_id;
            $assessmentGrade->student_id = $student_id;
            $assessmentGrade->marks_obtained = $marks_obtained;
            $assessmentGrade->attempts = 1;
            $exist->submitted_at = now();
            $save = $assessmentGrade->save();
        }


        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Your Response Submitted successfully'], 201);
        }

        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
    }
}
