<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public string $url;
    public string $apiKey;
    public string $clientId;
    public string $senderId;
  public function __construct()
  {
      $this->url = env('SMS_URL');
      $this->apiKey = env('SMS_API_KEY');
      $this->clientId = env('SMS_CLIENT_ID');
      $this->senderId = env('SMS_SENDER_ID');
  }

    public function verifyPhoneNumber(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:11',
        ]);

        // Attempt to retrieve the user with the student role
        $user = User::role('student')->where('phone', $request->phone)->first();

        // Generate a 4-digit OTP
        $otp = rand(1000, 9999);

        // If no user exists, create one and assign the student role
        if (!$user) {
            $user = new User();
            $user->phone = $request->phone;
            $user->name = Str::random(10);
            $user->slug = Str::random(10);
            $user->password = bcrypt('12345678');
            $user->email = Str::random(10) . '@gmail.com';
            $user->phone_verified = 0;
            $user->otp = $otp;
            $user->expires_at = now()->addMinutes(5);
            $user->save();
            $user->assignRole('student');
        }

        // If the phone is already verified, return a success response
        if ($user->phone_verified == 1) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Phone number already verified.',
                'phone'   => $request->phone
            ], 200);
        }

        // Update the user record with the new OTP and its expiry time (for both new and existing users)
        $user->otp = $otp;
        $user->expires_at = now()->addMinutes(5);
        $user->save();

        // Send the OTP via the SMS Gateway
        $response = Http::get($this->url, [
            'ApiKey'        => $this->apiKey,
            'ClientId'      => $this->clientId,
            'SenderId'      => $this->senderId,
            'Message'       => "Your OTP is $otp. Please use this code to complete your registration. Do not share it with anyone.",
            'MobileNumbers' => "88{$request->phone}",
        ]);

        // Optionally check the SMS response here
        if (!$response->successful()) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }

        // Return a response indicating that the OTP has been sent
        return response()->json([
            'status'    => 'pending',
            'message'   => 'OTP sent. Please verify your phone number.',
            'phone'     => $request->phone,
            // For debugging only—remove or hide the OTP in production
            'otp'       => $otp,
            'expires_at'=> $user->expires_at->format('Y-m-d H:i:s'),
            'sms_info'  => $response->body()
        ], 200);
    }


    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $phone = $request->phone;

        $exist = User::role('student')->where('phone', $phone)->first();

        if ($exist && Hash::check($request->password, $exist->password)) {
            Auth::login($exist);
           
            return response()->json(['status' => 'success','message' => 'user found'],200);
        } else {
            return response()->json(['status' => 'failed','message' => 'Wrong Password'],404);
        }
    }
}
