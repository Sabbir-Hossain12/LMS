<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkoutPage(string $slug)
    {
        $course = Course::where('slug', $slug)->first();
        
        return view('Frontend.pages.checkout.checkout-page', compact('course'));
        
    }
    
}
