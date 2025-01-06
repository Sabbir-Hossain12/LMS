<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Herobanner;
use App\Models\Testimonial;
use App\Models\TestimonialSetting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage()
    {
        
        $heroBanner= Herobanner::first();
        $classes = CourseClass::where('status',1)->where('is_featured',1)->get();
        $about= About::first();
        $testimonials= Testimonial::where('status',1)->get();
        $testimonialSetting= TestimonialSetting::first();
        $blogs= Blog::where('status',1)->limit(3)->get();
        
        $featuredCourses= Course::with('class','teacher')->where('status',1)->where('is_featured',1)->get();
        
//        dd($featuredCourses);
        return view('Frontend.pages.home',compact(['heroBanner','about','classes','testimonials','testimonialSetting','blogs','featuredCourses']));
    }
}
