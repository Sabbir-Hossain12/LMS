<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blogList()
    {
        $blogs= Blog::where('status',1)->with('author')->latest()->get();
        
        $recentBlogs= Blog::where('status',1)->with('author')->latest()->take(4)->get();
        
        return view('Frontend.pages.blog.blogs',compact('blogs','recentBlogs'));
    }


    public function blogDetails(string $slug)
    {
        
        $blog= Blog::where('slug',$slug)->with('author')->first();
        $recentBlogs= Blog::where('status',1)->with('author')->latest()->take(4)->get();
        
        return view('Frontend.pages.blog.blog-details',compact('blog','recentBlogs'));
        
    }
    
}
