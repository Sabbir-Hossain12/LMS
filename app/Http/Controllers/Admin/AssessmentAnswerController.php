<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentAnswer;
use App\Models\AssessmentGrade;
use Illuminate\Http\Request;

class AssessmentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
       
        $assessment_id = $id;
        
        $assessment = Assessment::find($assessment_id);

        $exam_answers = AssessmentAnswer::where('assessment_id', $assessment_id)
            ->with('student','assessment','assessmentGrade')
//            ->join('assessment_grades', 'assessment_grades.assessment_id', '=', 'assessment_id')
            ->get();
        

        return view('backend.pages.assessment-answers.index', compact('exam_answers','assessment'));
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
}
