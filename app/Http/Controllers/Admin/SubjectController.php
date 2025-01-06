<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id, Request $request)
    {
        $course = Course::find($id);
        $subjects = Subject::where('course_id', $id)->get();
        
        return view('backend.pages.subjects.index', compact('subjects','course'));
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
        
        $subject = new Subject();
        $subject->course_id = $request->course_id;
        $subject->title = $request->title;
        $subject->subtitle = $request->subtitle;
        $subject->slug  =Str::slug($request->title).uniqid();;
        $subject->desc = $request->desc;
        $subject->icon = $request->icon;
        $subject->position = $request->position;
        $subject->is_featured = $request->is_featured;
        $subject->status = $request->status;
        
        if ($request->hasFile('img')) {

            $file = $request->file('img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/subject/'), $filename);
            $subject->img ='backend/upload/subject/'. $filename;
        }
        if ($request->hasFile('meta_img')) {

            $file = $request->file('meta_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/subject/'), $filename);
            $subject->meta_img ='backend/upload/subject/'. $filename;
        }
            
        $subject->save();
        return redirect()->back()->with('success', 'Subject Added Successfully');
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
        $subject = Subject::find($id);
        
        if ($subject->img && file_exists(public_path($subject->img))) {
            unlink(public_path($subject->img));
        }
        if ($subject->meta_img && file_exists(public_path($subject->meta_img))) {
            unlink(public_path($subject->meta_img));
        }
        $subject->delete();
        return redirect()->back()->with('success', 'Subject Deleted Successfully');
    }
}
