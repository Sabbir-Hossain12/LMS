<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function loginPhonePage()
    {
        return view('Frontend.auth.phone');
    }
    
    public function verifyPhoneNumber(Request $request)
    {
        
    } 
    
}
