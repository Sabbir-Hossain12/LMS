<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class StudentAuthController extends Controller
{
    public function loginPhonePage()
    {
        return view('Frontend.auth.phone');
    }
    
    
    
    public function verifyPhoneNumber(Request $request)
    {
        $request->validate([
        'phone' => 'required|digits:11|numeric',
        ]);
        
        $exist= User::role('student')->where('phone', $request->phone)->first();
        Session::put('phone', $request->phone);
        $otp = rand(1000, 9999);
        
     if ($exist && $exist->phone_verified==1) {
         Session::forget('otp');
         Session::forget('expires_at');
         return response()->json(['status' => 'success','message' => 'verified'],200);
     } else {
         Session::put('otp', $otp);
         Session::put('expires_at', now()->addMinutes(5));
         
         //SMS Gateway
         $response = Http::get('http://202.72.233.114/api/v2/SendSMS', [
             'ApiKey' => 'JlqIGVfWLOQHg2cUCWsjqc3jLG4TS0b7e6QWkk4MPnU=',
             'ClientId' => '303614b6-0888-4ec6-93cc-2eccfa162a75',
             'SenderId' => '8809617621857',
             'Message' => "Your OTP is $otp. Please use this code to complete your Registration. Do not share it with anyone.",
             'MobileNumbers' => "88$request->phone",
         ]);

//         Http::get("http://202.72.233.114/api/v2/SendSMS?ApiKey=JlqIGVfWLOQHg2cUCWsjqc3jLG4TS0b7e6QWkk4MPnU=&ClientId=303614b6-0888-4ec6-93cc-2eccfa162a75&SenderId=8809617621857&Message=Your OTP is $otp. Please use this code to complete your Registration. Do not share it with anyone.&MobileNumbers=88$request->phone");

         return response()->json(['status' => 'failed','message' => 'not verified'],200);
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
            Auth::login($exist);
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
        $otp = Session::get('otp');
        $expires_at = Session::get('expires_at');
        

        if ( $otp == $request->otp ) {
//            Session::forget('otp');
//            Session::forget('expires_at');
            
            if ($expires_at > now())
            {
                
                return response()->json(['status' => 'success','message' => 'verified'],200);
            }
            else
            {
                return response()->json(['status' => 'failed','message' => 'OTP Expired'],200);
            }
 
        } else {
//            if ($expires_at > now())
//            {
//                Session::forget('otp');
//                Session::forget('expires_at');
//                return response()->json(['status' => 'failed','message' => 'OTP Expired'],404);
//            }
            return response()->json(['status' => 'failed','message' => 'Wrong Otp'],404);
        }
    }

    public function resendOtp(Request $request)
    {
        $otp = Session::get('otp');
        $expires_at = Session::get('expires_at');
        
        if ($expires_at > now()) {
            // Calculate the remaining time in seconds
            $remainingSeconds = $expires_at->diffInSeconds(now(), false);

            // Get the remaining minutes and seconds
            $remainingMinutes = floor(abs($remainingSeconds) / 60);
            $remainingSeconds = abs($remainingSeconds) % 60;

            // Format the remaining time as mm:ss
            $formattedRemainingTime = sprintf('%02d:%02d', $remainingMinutes, $remainingSeconds);
            
            return response()->json(['status' => 'failed','message' => 'Please try again after ' . $formattedRemainingTime . ' minutes','remaining_time'=> $formattedRemainingTime],200);
        }
        
        $otp=rand(1000, 9999);
        Session::put('otp', $otp);
        Session::put('expires_at', now()->addMinutes(5));
        $phone = Session::get('phone');
        
        //SMS Gateway
//        Http::get('http://202.72.233.114/api/v2/SendSMS?ApiKey=JlqIGVfWLOQHg2cUCWsjqc3jLG4TS0b7e6QWkk4MPnU=&ClientId=303614b6-0888-4ec6-93cc-2eccfa162a75&SenderId=8809617621857&Message=%22test_otp%22&MobileNumbers=8801926241906');

        $response = Http::get('http://202.72.233.114/api/v2/SendSMS', [
            'ApiKey' => 'JlqIGVfWLOQHg2cUCWsjqc3jLG4TS0b7e6QWkk4MPnU=',
            'ClientId' => '303614b6-0888-4ec6-93cc-2eccfa162a75',
            'SenderId' => '8809617621857',
            'Message' => "Your OTP is $otp. Please use this code to complete your Registration. Do not share it with anyone.",
            'MobileNumbers' => "88$phone",
        ]);
        
        return response()->json(['status' => 'success','message' => 'Otp sent successfully'],200);
        
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
            'phone' => 'required|digits:11|numeric',
        ]);
        
        $phone = Session::get('phone');

        $user = User::role('student')->where('phone', $phone)->first();
        
        if ($user) {
            $user->name = $request->name;
            $user->slug = Str::slug($request->name).uniqid();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_verified=1;
            $user->phone_verified_at=now();
            $save= $user->save();
        }
        else
        {
            $user = new User();
            $user->name = $request->name;
            $user->slug = Str::slug($request->name).uniqid();
            $user->email = $request->email;
            $user->phone = $phone;
            $user->password = Hash::make($request->password);
            $user->phone_verified=1;
            $user->phone_verified_at=now();

            $user->assignRole('student');
            $save= $user->save();
        }
        
        
       
       if ($save) {
           Auth::login($user);
           Session::forget('phone');
           Session::forget('otp');
           Session::forget('expires_at');
            return response()->json(['status' => 'success','message' => 'Student created successfully'],200);
        } else {
            return response()->json(['status' => 'failed','message' => 'User not created'],404);
        }
       
    }

    public function forgotPage()
    {
        $phone= Session::get('phone');
        $otp = rand(1000, 9999);
        Session::put('otp', $otp);
        Session::put('expires_at', now()->addMinutes(5));


        $response = Http::get('http://202.72.233.114/api/v2/SendSMS', [
            'ApiKey' => 'JlqIGVfWLOQHg2cUCWsjqc3jLG4TS0b7e6QWkk4MPnU=',
            'ClientId' => '303614b6-0888-4ec6-93cc-2eccfa162a75',
            'SenderId' => '8809617621857',
            'Message' => "Your OTP is $otp. Please use this code to complete your Registration. Do not share it with anyone.",
            'MobileNumbers' => "88$phone",
        ]);

//        return response()->json(['status' => 'success','message' => 'Otp sent successfully'],200);
        return view('Frontend.auth.forgot-password');
    }

    public function resetPage()
    {
        return view('Frontend.auth.reset-password');
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);
        
        $phone= Session::get('phone');

        $user = User::role('student')->where('phone', $phone)->first();
        
        if ($user) {
            $user->password = Hash::make($request->password);
            $save= $user->save();
            
            return response()->json(['status' => 'success','message' => 'Password reset successfully'],200);
        }
        else
        {
            return response()->json(['status' => 'failed','message' => 'User not found'],404);
        }
        
    
    }
    
    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        
        return response()->json(['status' => 'success','message' => 'Successfully logged out'],200);
//        return redirect()->to('/');
        
    }


}
