<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssessmentAnswer;
use App\Models\AssessmentGrade;
use Illuminate\Http\Request;

class AssessmentGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function markEvaluation(Request $request)
    {
        $request->validate([
            'marks_obtained'=>['required'],
        ]);
        
        $assessment_answer_id = $request->assessment_answer_id;
        $assessment_id = $request->assessment_id;
        $student_id = $request->student_id;
        
        $assessment_answer= AssessmentAnswer::where('id', $assessment_answer_id)->first();
        
        $exist= AssessmentGrade::where('assessment_answer_id', $assessment_answer_id)
            ->where('student_id', $student_id)
            ->first();
        
        if ($exist) {
            $exist->marks_obtained=$request->marks_obtained;
            $exist->save();

            $assessment_answer->status=1;
            $assessment_answer->save();
            
        }
        else
        {
            $assessment_grade = new AssessmentGrade();
            $assessment_grade->assessment_answer_id=$assessment_answer_id;
            $assessment_grade->assessment_id=$assessment_id;
            $assessment_grade->student_id=$student_id;
            $assessment_grade->marks_obtained=$request->marks_obtained;
            $assessment_grade->save();

            $assessment_answer->status=1;
            $assessment_answer->save();
        }
        
        return redirect()->back()->with('success', 'Marks updated successfully');
    }
    
       public function teacherUpload(Request $request)
        {
    
        // dd($request->all());
        $assessment_answer_id = $request->assessment_answer_id;
        $assessment_id = $request->assessment_id;
        $student_id = $request->student_id;
        
        $assessment_answer= AssessmentAnswer::where('id', $assessment_answer_id)->first();
        
        $exist= AssessmentGrade::where('assessment_answer_id', $assessment_answer_id)
            ->where('student_id', $student_id)
            ->first();
        
        if ($exist) {
          
            if ($request->hasFile('teacher_upload')) {
                
                 if ($exist->teacher_upload && file_exists(public_path($exist->teacher_upload))) {
                    unlink(public_path($exist->teacher_upload));
                }
                
                
                $file = $request->file('teacher_upload');
                $fileName = time().uniqid().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('backend/upload/assignments/'), $fileName);
                $exist->teacher_upload = 'backend/upload/assignments/'.$fileName;
                $exist->save();
            }
            
            
            return redirect()->back()->with('success', 'Document uploaded successfully');
            
        }
        
         return redirect()->back()->with('error', 'Update the Mark First');
       
        
        
    }
}
