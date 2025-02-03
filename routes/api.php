<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
Route::prefix('student/login')->name('api.student.')->group(function ()
{
   
    Route::post('/phone/verify', [ApiController::class,'verifyPhoneNumber'])->middleware('throttle:4,1')->name('phone-verify');
    Route::post('/password/verify', [ApiController::class,'verifyPassword'])->name('password-verify');
    Route::post('/otp/verify', [ApiController::class,'verifyOtp'])->name('otp-verify');
    Route::post('/otp/resend', [ApiController::class,'resendOtp'])->name('otp-resend');
    Route::post('/register/submit', [ApiController::class,'register'])->name('register');
    Route::post('/reset-password', [ApiController::class,'resetPassword'])->name('reset-password');
    Route::post('/log-out', [ApiController::class,'logOut'])->middleware('auth:sanctum')->name('log-out');

});


