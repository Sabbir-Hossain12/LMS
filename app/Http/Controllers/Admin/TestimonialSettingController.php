<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialSetting;
use Illuminate\Http\Request;

class TestimonialSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testSettings= TestimonialSetting::first();
        return view('backend.pages.website.testimonial-settings',compact('testSettings'));
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
        
        $testSettings= new TestimonialSetting();
        $testSettings->short_title=$request->short_title;
        $testSettings->main_title=$request->main_title;
        
        if ($request->hasFile('side_img')) {
            
            $file = $request->file('side_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalName();
            $file->move(public_path('backend/upload/testimonial'), $filename);
            $testSettings->side_img ='backend/upload/testimonial/' . $filename;
        }
        
       $save = $testSettings->save();
        
        if ($save) {
            return redirect()->back()->with('success', 'Data updated successfully');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testSettings= TestimonialSetting::first();
        $testSettings->short_title=$request->short_title;
        $testSettings->main_title=$request->main_title;
        
        if ($request->hasFile('side_img')) {
            
            if ($testSettings->side_img && file_exists(public_path($testSettings->side_img))) {
                
                unlink(public_path($testSettings->side_img));
            }
            
            $file = $request->file('side_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalName();
            $file->move(public_path('backend/upload/testimonial'), $filename);
            $testSettings->side_img ='backend/upload/testimonial/' . $filename;
        }
        
       $save = $testSettings->save();
        
        if ($save) {
            return redirect()->back()->with('success', 'Data updated successfully');
        }
        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
