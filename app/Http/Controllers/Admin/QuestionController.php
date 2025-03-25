<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $course=Course::find($id);

        $assessments= Assessment::whereHas('lesson.subject.course', function ($query) use ($id) {

            $query->where('id', $id);
        })->get();

        $questions= Question::whereHas('assessment.lesson.subject.course', function ($query) use ($id) {

            $query->where('id', $id);

        })->get();


        return view('backend.pages.lesson-questions.index',compact('course','assessments','questions'));

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
//        dd($request->all());
        
        $question=new Question();
        $question->assessment_id=$request->assessment_id;
        $question->question_text=$request->question_text;
        $question->marks=$request->marks;
        $question->correct_option=$request->correct_option;
        $question->status=$request->status;

        // Create an associative array with keys "A", "B", "C", "D"
        $optionsWithKeys = [];
        $letters = range('A', 'Z'); // Creates an array with letters from A to B

        foreach ($request->options as $index => $value) {
            $optionsWithKeys[$letters[$index]] = $value;
        }

        
        
        $question->options= json_encode($optionsWithKeys);
//        dd($question->options);
        if ($request->hasFile('question_image')) {
            
            $file = $request->file('question_image');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/questions/'), $filename);
            $question->question_image ='backend/upload/questions/'. $filename;
        }
        
        
        $save= $question->save();
        
        if ($save) {
            return redirect()->back()->with('success', 'Question Created Successfully');
        }
        
        return redirect()->back()->with('error', 'Something went wrong');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question= Question::find($id);
        $assessments = Assessment::all();
        
//        $assessments= Assessment::where('lesson_id',$question->assessment->lesson_id)->get();
        
//        $lessons=Lesson::where('subject_id',$question->assessment->lesson->subject_id)->get();
       
        return view('backend.pages.lesson-questions.edit',compact('question','assessments'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question= Question::find($id);
        $question->assessment_id=$request->assessment_id;
        $question->question_text=$request->question_text;
        $question->marks=$request->marks;
        $question->correct_answers=$request->correct_answers;
        $question->status=$request->status;
        $question->options= json_encode($request->options);

        if ($request->hasFile('question_image')) {

            if ($question->question_image && file_exists(public_path($question->question_image))) {
                unlink(public_path($question->question_image));
            }
            
            $file = $request->file('question_image');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/questions/'), $filename);
            $question->question_image ='backend/upload/questions/'. $filename;
        }
        
        
        $save= $question->save();
        
        if ($save) {
            return redirect()->back()->with('success', 'Question Updated Successfully');
        }
        
        return redirect()->back()->with('error', 'Something went wrong');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyAssessmentQuestion(string $id)
    {
//        dd($id);
        Question::where('id',$id)->delete();
        
        return redirect()->back()->with('success', 'Question Deleted Successfully');
    }
}
