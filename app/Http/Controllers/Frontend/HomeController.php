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
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homePage()
    {
        
        $heroBanner= Herobanner::first();
        $services = CourseClass::where('status',1)->where('is_featured',1)->orderBy('position','asc')->get();
        $about= About::first();
        $testimonials= Testimonial::where('status',1)->get();
        $testimonialSetting= TestimonialSetting::first();
        $featuredCourses= Course::with('class','teacher')->where('status',1)->where('is_featured',1)->get();
        $teachers= User::role('teacher')->where('status',1)->get();
        $blogs= Blog::where('status',1)->limit(3)->get();
        
        $randomCourse= Course::where('status',1)->inRandomOrder()->limit(6)->get();
        $courseClasses= CourseClass::where('status',1)->where('is_featured',1)->orderBy('position','asc')->limit(4)->get();
        
        
        return view('Frontend.pages.home',compact(['heroBanner','randomCourse','courseClasses','teachers','about','services','testimonials','testimonialSetting','blogs','featuredCourses']));
    }
}
