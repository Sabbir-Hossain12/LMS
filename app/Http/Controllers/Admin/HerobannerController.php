<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Herobanner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class HerobannerController extends Controller
{
    
    public static function middleware(): array
    {
        return [

            new Middleware('permission:View Admin,admin', only: ['index']),
            new Middleware('permission:Create Admin,admin', only: ['store']),
            new Middleware('permission:Edit Admin,admin', only: ['update']),
            new Middleware('permission:Delete Admin,admin', only: ['destroy']),
            new Middleware('permission:Status Admin,admin', only: ['changeAdminStatus']),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroBanner= Herobanner::first();
        
        return view('backend.pages.website.herobanner',compact('heroBanner'));
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
        $heroBanner= new Herobanner();
        
        $heroBanner->short_title = $request->short_title;
        $heroBanner->main_title = $request->main_title;
        $heroBanner->sub_title = $request->sub_title;
        $heroBanner->btn1_text = $request->btn1_text;
        $heroBanner->btn1_link = $request->btn1_link;
        $heroBanner->btn2_text = $request->btn2_text;
        $heroBanner->btn2_link = $request->btn2_link;
        $heroBanner->video_url = $request->video_url;
        
        if ($request->hasFile('video_thumbnail_img')) {
            
            $file = $request->file('video_thumbnail_img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/herobanner/'), $filename);
            $heroBanner->video_thumbnail_img = 'backend/upload/herobanner/' . $filename;
        }

       $save= $heroBanner->save();
        
        if ($save) {
            Toastr::success('Success','Hero Banner Stored Successfully.');
            return redirect()->back()->with('success', 'Herobanner Added Successfully');
        }
        
            return redirect()->back()->with('error', 'Herobanner Not Added Successfully');
        
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
        
        $heroBanner= Herobanner::first();
        
        $heroBanner->short_title = $request->short_title;
        $heroBanner->main_title = $request->main_title;
        $heroBanner->sub_title = $request->sub_title;
        $heroBanner->btn1_text = $request->btn1_text;
        $heroBanner->btn1_link = $request->btn1_link;
        $heroBanner->btn2_text = $request->btn2_text;
        $heroBanner->btn2_link = $request->btn2_link;
        $heroBanner->video_url = $request->video_url;
        
        if ($request->hasFile('video_thumbnail_img')) {
            
            if ($heroBanner->video_thumbnail_img && file_exists(public_path($heroBanner->video_thumbnail_img))) {
                
                unlink(public_path($heroBanner->video_thumbnail_img));
            }
            
            $file = $request->file('video_thumbnail_img');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/herobanner/'), $filename);
            $heroBanner->video_thumbnail_img = 'backend/upload/herobanner/' . $filename;
        }
        
       $save= $heroBanner->save();
        
        if ($save) {
            Toastr::success('Success','Hero Banner Update Successfully.');
            return redirect()->back()->with('success', 'Herobanner Updated Successfully');
        }
        
            return redirect()->back()->with('error', 'Herobanner Not Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
