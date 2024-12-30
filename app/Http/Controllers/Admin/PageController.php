<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages=Page::all();
        return view('backend.pages.website.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.website.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            
            'name' => ['required', 'string', 'max:255'],
            
        ]);
        $page=new Page();
        
        $page->name=$request->name;
        $page->slug =Str::slug($request->name);
        $page->title=$request->title;
        $page->type=$request->type;
        $page->short_desc=$request->short_desc;
        $page->long_desc=$request->long_desc;
        $page->meta_title=$request->meta_title;
        $page->meta_desc=$request->meta_desc;
        $page->meta_keywords=$request->meta_keywords;
        
        
        if ($request->hasFile('img')) {
            
            $file = $request->file('img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/page/'), $filename);
            $page->img ='backend/upload/page/'. $filename;
        }
        
        if ($request->hasFile('meta_img')) {
            
            $file = $request->file('meta_img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/page/'), $filename);
            $page->meta_img ='backend/upload/page/'. $filename;
        }
        
        
        
      $save=  $page->save();
        
        if (!$save) {
            return redirect()->route('admin.page.index')->with('error','Something went wrong');
        }
        return redirect()->route('admin.page.index')->with('success','Page Created Successfully');
        
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
        $page=Page::find($id);
        return view('backend.pages.website.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page=Page::find($id);
        $page->name=$request->name;
        $page->title=$request->title;
        $page->slug =Str::slug($request->name);
        $page->type=$request->type;
        $page->short_desc=$request->short_desc;
        $page->long_desc=$request->long_desc;
        $page->meta_title=$request->meta_title;
        $page->meta_desc=$request->meta_desc;
        $page->meta_keywords=$request->meta_keywords;
        
        if ($request->hasFile('img')) {
            
            if ($page->img && file_exists(public_path($page->img))) {
                unlink(public_path($page->img));
                
            }
            $file = $request->file('img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/page/'), $filename);
            $page->img ='backend/upload/page/'. $filename;
        }
        
        if ($request->hasFile('meta_img')) {
            
            if ($page->meta_img && file_exists(public_path($page->meta_img))) {
                unlink(public_path($page->meta_img));
                
            }
            $file = $request->file('meta_img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/page/'), $filename);
            $page->meta_img ='backend/upload/page/'. $filename;
        }
        
        $save=  $page->save();
        
        if (!$save) {
            return redirect()->route('admin.page.index')->with('error','Something went wrong');
        }
        return redirect()->back()->with('success','Page Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page=Page::find($id);
        if ($page->img && file_exists(public_path($page->img))) {
            unlink(public_path($page->img));
        }
        $delete=$page->delete();
        if ($delete) {
            return redirect()->back()->with('success','Page Deleted Successfully');
        }
        return redirect()->back()->with('error','Something went wrong');
    }
}
