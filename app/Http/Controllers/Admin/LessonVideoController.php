<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonVideo;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LessonVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id, Request $request)
    {
        $course = Course::find($id);
        $subjects = Subject::where('course_id', $id)->get();

        $lessons = Lesson::whereHas('subject.course', function ($q) use ($id) {
            $q->where('id', $id);
        })->get();

        $lessonVideos = LessonVideo::whereHas('lesson.subject.course', function ($q) use ($id) {
            $q->where('id', $id);
        })->get();


        return view('backend.pages.lesson-videos.index', compact('lessonVideos', 'course', 'subjects', 'lessons'));
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
        $lessonVideo = new LessonVideo();
        $lessonVideo->lesson_id = $request->lesson_id;
        $lessonVideo->title = $request->title;
        $lessonVideo->slug = Str::slug($request->title);
        $lessonVideo->video_url = $request->video_url;
        $lessonVideo->duration = $request->duration;
        $lessonVideo->start_time = $request->start_time;
        $lessonVideo->end_time = $request->end_time;
        $lessonVideo->position = $request->position;
        $lessonVideo->status = $request->status;

        $save = $lessonVideo->save();
        if ($save) {
            return redirect()->back()->with('success', 'Video Added Successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
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
        $lessonVideo = LessonVideo::find($id);

        $lessons = Lesson::where('subject_id', $lessonVideo->lesson->subject_id)->get();

        return view('backend.pages.lesson-videos.edit', compact('lessonVideo', 'lessons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lessonVideo = LessonVideo::find($id);
        $lessonVideo->lesson_id = $request->lesson_id;
        $lessonVideo->title = $request->title;
        $lessonVideo->video_url = $request->video_url;
        $lessonVideo->duration = $request->duration;
        $lessonVideo->start_time = $request->start_time;
        $lessonVideo->end_time = $request->end_time;
        $lessonVideo->position = $request->position;
        $lessonVideo->status = $request->status;

        $save = $lessonVideo->save();
        if ($save) {
            return redirect()->back()->with('success', 'Video Update Successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyLessonVideo(string $id)
    {
        $lessonVideo = LessonVideo::find($id);
        $lessonVideo->delete();

        return redirect()->back()->with('success', 'Video Deleted Successfully');
    }
}
