<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('Frontend.pages.dashboard.index');
    }

    public function profilePage()
    {
        return view('Frontend.pages.dashboard.profile');
    }
    
    public function settingsPage()
    {
        return view('Frontend.pages.dashboard.settings');
    } 
    
    public function wishlistPage()
    {
        return view('Frontend.pages.dashboard.wishlist');
    }

    public function coursesPage()
    {
        return view('Frontend.pages.dashboard.courses');
    }

    public function examAttemptsPage()
    {
        return view('Frontend.pages.dashboard.exam-attempts');
    }
    
    public function assignmentsPage()
    {
        return view('Frontend.pages.dashboard.assignments');
    }
    
    public function reviewsPage()
    {
        return view('Frontend.pages.dashboard.reviews');
    }
}
