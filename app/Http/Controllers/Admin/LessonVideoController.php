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
    //  dd($request->all());
    // return $request;
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
        
        if ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
             $file->move(public_path('backend/upload/lesson-videos/'), $filename);
            $lessonVideo->video_file = 'backend/upload/lesson-videos/'.$filename;
        }

        $save = $lessonVideo->save();
        if ($save) {
            // return redirect()->back()->with('success', 'Video Added Successfully');
            
        return response()->json(['status' => 'success', 'message' => 'Video Added Successfully'], 200);

        }

        // return redirect()->back()->with('error', 'Something went wrong');
         return response()->json(['status' => 'error', 'message' => 'Something Went Wrong'], 500);

    }
    
//     public function store(Request $request)
//     {
//         return $request->all();
//     try {
//         $lessonVideo = new LessonVideo();
//         $lessonVideo->lesson_id = $request->lesson_id;
//         $lessonVideo->title = $request->title;
//         $lessonVideo->slug = Str::slug($request->title);
//         $lessonVideo->video_url = $request->video_url;
//         $lessonVideo->duration = $request->duration;
//         $lessonVideo->start_time = $request->start_time;
//         $lessonVideo->end_time = $request->end_time;
//         $lessonVideo->position = $request->position;
//         $lessonVideo->status = $request->status;

//         // Handle video file upload
//         if ($request->hasFile('video_file')) {
//             $file = $request->file('video_file');

//             if (!$file->isValid()) {
//                 Log::error('Invalid video file uploaded.', [
//                     'lesson_id' => $request->lesson_id,
//                     'filename' => $file->getClientOriginalName(),
//                 ]);
//                 return response()->json(['status' => 'error', 'message' => 'Invalid video file.'], 400);
//             }

//             $filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();

//             try {
//               return  $file->move(public_path('backend/upload/lesson-videos/'), $filename);
//                 $lessonVideo->video_file = 'backend/upload/lesson-videos/' . $filename;
//             } catch (Exception $e) {
//                 Log::error('Video file move failed.', [
//                     'lesson_id' => $request->lesson_id,
//                     'filename' => $filename,
//                     'error' => $e->getMessage(),
//                 ]);
//                 return response()->json(['status' => 'error', 'message' => 'File upload failed.'], 400);
//             }
//         }

//         $lessonVideo->save();

//         return response()->json(['status' => 'success', 'message' => 'Video Added Successfully'], 200);

//     } catch (Exception $e) {
//         // Log any general or unexpected errors
//         Log::error('Error saving lesson video.', [
//             'lesson_id' => $request->lesson_id,
//             'error' => $e->getMessage(),
//             'trace' => $e->getTraceAsString(),
//         ]);

//         return response()->json(['status' => 'error', 'message' => 'Something went wrong while saving video.'], 500);
//     }
// }

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
        
        if ($request->hasFile('video_file')) {
            
           if ($lessonVideo->video_file && file_exists(public_path($lessonVideo->video_file))) {
                 unlink(public_path($lessonVideo->video_file));
            }
            
            $file = $request->file('video_file');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/lesson-videos/'), $filename);
            $lessonVideo->video_file = 'backend/upload/lesson-videos/'.$filename;
        }

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
        
         if ($lessonVideo->video_file && file_exists(public_path($lessonVideo->video_file))) {
                 unlink(public_path($lessonVideo->video_file));
            }
            
        $lessonVideo->delete();

        return redirect()->back()->with('success', 'Video Deleted Successfully');
    }
}
