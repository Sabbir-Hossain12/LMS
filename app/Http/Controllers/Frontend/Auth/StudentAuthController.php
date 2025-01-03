<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class StudentAuthController extends Controller
{
    public function loginPhonePage()
    {
        return view('Frontend.auth.phone');
    }
    
    
    
    public function verifyPhoneNumber(Request $request)
    {
        $request->validate([
            'phone' => 'required|max:11|min:11|numeric'
        ]);
        
     $exist=   User::role('student')->where('phone', $request->phone)->first();
        Session::put('phone', $request->phone);
        
     if ($exist && $exist->phone_verified==1) {
         return response()->json(['status' => 'success','message' => 'verified','phone' => $exist->phone],200);
     } else {
         $otp = rand(1000, 9999);
         $exist->otp=$otp;
         $exist->save();
         //SMS Gateway
         return response()->json(['status' => 'failed','message' => 'not verified','phone' => $exist->phone,'otp'=>$otp],200);
     }
     
        
    }

    public function loginPasswordPage()
    {
        return view('Frontend.auth.password');
    }



    public function verifyPassword(Request $request)
    {
         $request->validate([
            'password' => 'required'
        ]);

        $phone = Session::get('phone');
        
        $exist = User::role('student')->where('phone', $phone)->first();
        
        if ($exist && Hash::check($request->password, $exist->password)) {
            Session::forget('phone');
            return response()->json(['status' => 'success','message' => 'user found'],200);
        } else {
            return response()->json(['status' => 'failed','message' => 'Wrong Password'],404);
        }
    }

  

    public function loginOtpPage()
    {
        return view('Frontend.auth.otp');
    }

    public function verifyOtp(Request $request)
    {

        $request->validate([
            'otp' => 'required'
        ]);

        $phone = Session::get('phone');
        $exist = User::role('student')->where('phone', $phone)->first();

        if ($exist && $exist->otp == $request->otp) {
            Session::forget('phone');
            return response()->json(['status' => 'success','message' => 'verified'],200);
        } else {
            return response()->json(['status' => 'failed','message' => 'Wrong Otp'],404);
        }
    }


    public function registerPage()
    {
        return view('Frontend.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'password' => 'required|confirmed',
            'phone' => 'required|max:11|min:11|numeric',
        ]);
        
        $phone = Session::get('phone');
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $phone;
        $user->password = Hash::make($request->password);
        $user->assignRole('student');
       $save= $user->save();
       
       if ($save) {
           Session::forget('phone');
            return response()->json(['status' => 'success','message' => 'Student created successfully'],200);
        } else {
            return response()->json(['status' => 'failed','message' => 'User not created'],404);
        }
       
    }

//    public function forgotPage()
//    {
//        return view('Frontend.auth.forgot-password');
//    }
//    
//
//    public function resetPage()
//    {
//        return view('Frontend.auth.reset-password');
//    }
    
}
