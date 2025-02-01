<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('student/login')->name('api.student.')->group(function ()
{
   
    Route::post('/phone/verify', [ApiController::class,'verifyPhoneNumber'])->name('phone-verify');
    Route::get('/password', [ApiController::class,'loginPasswordPage'])->name('password-page');
    Route::post('/password/verify', [ApiController::class,'verifyPassword'])->name('password-verify');
    Route::get('/otp', [ApiController::class,'loginOtpPage'])->name('otp-page');
    Route::post('/otp/verify', [ApiController::class,'verifyOtp'])->name('otp-verify');
    Route::post('/otp/resend', [ApiController::class,'resendOtp'])->name('otp-resend');
    Route::get('/register', [ApiController::class,'registerPage'])->name('register-page');
    Route::post('/register/submit', [ApiController::class,'register'])->name('register');
    Route::get('/forgot-password-page', [ApiController::class,'forgotPage'])->name('forgot-page');
    Route::get('/forgot-password', [ApiController::class,'forgotPassword'])->name('forgot-password');
    Route::get('/reset-page', [ApiController::class,'resetPage'])->name('reset-page');
    Route::post('/reset-password', [ApiController::class,'resetPassword'])->name('reset-password');
    Route::post('/log-out', [ApiController::class,'logOut'])->name('log-out');

});
