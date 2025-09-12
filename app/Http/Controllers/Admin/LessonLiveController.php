<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonLive;
use Illuminate\Http\Request;

class LessonLiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $course = Course::find($id);

        $lessons = Lesson::whereHas('subject.course', function ($q) use ($id) {
            $q->where('id', $id);
        })->get();

        $lessonLive = LessonLive::whereHas('lesson.subject.course', function ($q) use ($id) {
            $q->where('id', $id);
        })->get();

// dd($lessonLive);
        return view('backend.pages.lesson-live.index', compact('lessonLive', 'course', 'lessons'));
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
        $lessonLive = new LessonLive();
        $lessonLive->title = $request->title;
        $lessonLive->lesson_id = $request->lesson_id;
        $lessonLive->class_link = $request->class_link;
        $lessonLive->status = $request->status;

        $lessonLive->save();

        return redirect()->back()->with('success', 'Live Class Added Successfully');
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
    public function edit(string $id)
    {
        $lessonLive = LessonLive::find($id);

        $lessons = Lesson::where('subject_id', $lessonLive->lesson->subject_id)->get();
        return view('backend.pages.lesson-live.edit', compact('lessonLive', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lessonLive = LessonLive::find($id);
        $lessonLive->title = $request->title;
        $lessonLive->lesson_id = $request->lesson_id;
        $lessonLive->class_link = $request->class_link;
        $lessonLive->status = $request->status;
        
        $lessonLive->save();

        return redirect()->back()->with('success', 'Live Class Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyLessonLive(string $id)
    {
        $lessonLive = LessonLive::find($id);
        
        $lessonLive->delete();
        
        return redirect()->back()->with('success', 'Live Class Deleted Successfully');
    }
}
