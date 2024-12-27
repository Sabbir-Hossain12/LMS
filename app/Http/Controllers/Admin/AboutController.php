<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about= About::first();
        
        return view('backend.pages.website.about',compact('about'));
        
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
        $about= new About();
        $about->short_title=$request->short_title;
        $about->main_title=$request->main_title;
        $about->desc=$request->desc;
        
        if ($request->hasFile('side_img')) {
            
            $file = $request->file('side_img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/about/'), $filename);
            $about->side_img = 'backend/upload/about/' . $filename;
            
        }
        
        $about->save();
        
        return redirect()->back()->with('success','Data updated successfully');
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
        $about= About::first();
        $about->short_title=$request->short_title;
        $about->main_title=$request->main_title;
        $about->desc=$request->desc;
        
        if ($request->hasFile('side_img')) {
            
            if ($about->side_img && file_exists(public_path($about->side_img))) {
                unlink(public_path($about->side_img));
                
            }
            
            $file = $request->file('side_img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/about/'), $filename);
            $about->side_img = 'backend/upload/about/' . $filename;
            
        }
        
        $about->save();
        
        return redirect()->back()->with('success','Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
