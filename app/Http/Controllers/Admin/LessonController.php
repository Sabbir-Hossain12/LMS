<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id, Request $request)
    {
        $course = Course::find($id);
        $subjects= Subject::where('course_id',$id)->get();
        $lessons=   Lesson::whereHas('subject.course',function ($q) use ($id)
        
     {
         $q->where('id',$id);
     })->get();
        
        return view('backend.pages.lessons.index',compact('lessons','course','subjects'));
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
        $lesson = new Lesson();
        $lesson->course_id = $request->course_id;
        $lesson->subject_id = $request->subject_id;
        $lesson->title = $request->title;
        $lesson->slug = Str::slug($request->title).uniqid() ;
        $lesson->subtitle = $request->subtitle;
        $lesson->desc = $request->desc;
        $lesson->position = $request->position;
        $lesson->status = $request->status;
        
        $save=$lesson->save();
        
        if ($save) {
            
        return redirect()->back()->with('success','Lesson Added Successfully');
        }
        
        return redirect()->back()->with('error','Something went wrong');
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
        
        $lesson = Lesson::find($id);
        
        $subjects= Subject::where('course_id',$lesson->subject->course_id)->get();
        return view('backend.pages.lessons.edit',compact('lesson','subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lesson = Lesson::find($id);
        $lesson->subject_id = $request->subject_id;
        $lesson->title = $request->title;
        $lesson->subtitle = $request->subtitle;
        $lesson->desc = $request->desc;
        $lesson->position = $request->position;
        $lesson->status = $request->status;

        $save=$lesson->save();

        if ($save) {

            return redirect()->back()->with('success','Lesson Update Successfully');
        }

        return redirect()->back()->with('error','Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyLesson(string $id)
    {
        
//        dd('works');
        
        $lesson = Lesson::find($id);
        $lesson->delete();
        return redirect()->back()->with('success','Lesson Deleted Successfully');
        
    }
}
