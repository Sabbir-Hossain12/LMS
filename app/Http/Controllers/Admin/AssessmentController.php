<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $course=Course::find($id);
        
        $lessons= Lesson::whereHas('subject.course', function ($query) use ($id) {
            
            $query->where('id', $id);
        })->get();
        
        $lessonAssessment= Assessment::whereHas('lesson.subject.course', function ($query) use ($id) {
            
            $query->where('id', $id);
            
        })->get();
        
        return view('backend.pages.lesson-assessment.index',compact('course','lessons','lessonAssessment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//      dd($request->all());
        $assessment=new Assessment();
        $assessment->course_id =$request->course_id;
        $assessment->lesson_id =$request->lesson_id;
        $assessment->duration=$request->duration;
        $assessment->type=$request->type;
        $assessment->title=$request->title;
        $assessment->desc=$request->desc;
        $assessment->total_marks=$request->total_marks;
        $assessment->start_time=$request->start_time;
        $assessment->end_time=$request->end_time;
        $assessment->status=$request->status;
        
        
        $assessment->save();
        return redirect()->back()->with('success','Assessment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessment $assessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $assessment=Assessment::find($id);

        $lessons = Lesson::where('subject_id', $assessment->lesson->subject_id)->get();
        
        return view('backend.pages.lesson-assessment.edit',compact('assessment','lessons'));
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assessment=Assessment::find($id);
        $assessment->lesson_id =$request->lesson_id;
         $assessment->duration=$request->duration;
        $assessment->type=$request->type;
        $assessment->title=$request->title;
        $assessment->desc=$request->desc;
        $assessment->total_marks=$request->total_marks;
        $assessment->start_time=$request->start_time;
        $assessment->end_time=$request->end_time;
        $assessment->status=$request->status;


        $assessment->save();
        return redirect()->back()->with('success','Assessment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyLessonAssessment(string $id)
    {
        Assessment::where('id', $id)->delete();
        
        return redirect()->back()->with('success','Assessment Deleted Successfully');
    }
}
