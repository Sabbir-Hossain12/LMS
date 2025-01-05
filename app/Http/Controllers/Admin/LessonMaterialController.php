<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonMaterial;
use Illuminate\Http\Request;

class LessonMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $course=Course::find($id);
        
        $lessons=Lesson::whereHas('subject.course',function ($q) use ($id)
        {
            $q->where('id',$id);
        })->get();
        
        $lessonMaterial=LessonMaterial::whereHas('lesson.subject.course',function ($q) use ($id)
        {
            $q->where('id',$id);
        })->get();
        
        return view('backend.pages.lesson-materials.index',compact('lessonMaterial','course','lessons'));
        
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
        
        $courseMaterial=new LessonMaterial();
        $courseMaterial->title=$request->title;
        $courseMaterial->lesson_id=$request->lesson_id;
        $courseMaterial->type=$request->type;
        $courseMaterial->text=$request->text;
        $courseMaterial->url=$request->url;
        $courseMaterial->status=$request->status;
        
        if ($request->hasFile('file')) {
            
            $file = $request->file('file');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/lesson-materials/'), $filename);
            $courseMaterial->file ='backend/upload/lesson-materials/'. $filename;
        }
        
        $courseMaterial->save();
        
        return redirect()->back()->with('success','Material Added Successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(LessonMaterial $lessonMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LessonMaterial $lessonMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LessonMaterial $lessonMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LessonMaterial $lessonMaterial)
    {
        //
    }
}
