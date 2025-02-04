<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Basicinfo;
use App\Models\Blog;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Enrollment;
use App\Models\Herobanner;
use App\Models\Page;
use App\Models\Subject;
use App\Models\Testimonial;
use App\Models\TestimonialSetting;
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
            $user->email = Str::random(10).'@gmail.com';
            $user->phone_verified = 0;
            $user->otp = $otp;
            $user->expires_at = now()->addMinutes(5);
            $user->save();
            $user->assignRole('student');
        }

        // If the phone is already verified, return a success response
        if ($user->phone_verified == 1) {
            return response()->json([
                'status' => 'success',
                'message' => 'Phone number already verified.',
                'phone' => $request->phone
            ], 200);
        }

        // Update the user record with the new OTP and its expiry time (for both new and existing users)
        $user->otp = $otp;
        $user->expires_at = now()->addMinutes(5);
        $user->save();

        // Send the OTP via the SMS Gateway
        $response = Http::get($this->url, [
            'ApiKey' => $this->apiKey,
            'ClientId' => $this->clientId,
            'SenderId' => $this->senderId,
            'Message' => "Your OTP is $otp. Please use this code to complete your registration. Do not share it with anyone.",
            'MobileNumbers' => "88{$request->phone}",
        ]);

        // Optionally check the SMS response here
        if (!$response->successful()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send OTP. Please try again later.'
            ], 500);
        }

        // Return a response indicating that the OTP has been sent
        return response()->json([
            'status' => 'pending',
            'message' => 'OTP sent. Please verify your phone number.',
            'phone' => $request->phone,
            // For debugging only—remove or hide the OTP in production
            'otp' => $otp,
            'expires_at' => $user->expires_at->format('Y-m-d H:i:s'),
            'sms_info' => $response->body()
        ], 200);
    }


    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'phone' => 'required | digits:11 | starts_with:01',
        ]);

        $phone = $request->phone;

        $user = User::role('student')->where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401); // 401 for "unauthorized"
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'user found',
            'token' => $token,
            'user' => $user
        ],
            200);
    }

    public function logOut(Request $request)
    {
        $user = $request->user();

        //Logout from current device
//        $user->currentAccessToken()->delete();

        //Logout from all devices
        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'user logged out',
        ],
            200);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:4',       // Expecting a 4-digit OTP
            'phone' => 'required|digits:11|starts_with:01',

        ]);

        $phone = $request->phone;
        $otp = $request->otp;

        // Find the user with the 'student' role by phone number.
        $user = User::role('student')->where('phone', $phone)->first();

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        // First, check if the OTP matches.
        if ($user->otp != $otp) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Wrong OTP'
            ], 400);
        }

        // Then, check if the OTP is still valid based on the expiration stored in the database.
        if ($user->expires_at <= now()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'OTP Expired'
            ], 400);
        }

        // If the OTP is correct and hasn't expired, mark the phone as verified and clear OTP fields.
        $user->phone_verified = 1;
        $user->otp = 0; // or null, depending on your convention
        $user->expires_at = null;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Verified'
        ], 200);
    }

    public function resendOtp(Request $request)
    {
        $otp = rand(1000, 9999);
        $phone = $request->phone;
        $user = User::role('student')->where('phone', $phone)->first();


        if ($user->expires_at > now()) {
            // Calculate the remaining time in seconds
            $remainingSeconds = $user->expires_at->diffInSeconds(now(), false);

            // Get the remaining minutes and seconds
            $remainingMinutes = floor(abs($remainingSeconds) / 60);
            $remainingSeconds = abs($remainingSeconds) % 60;

            // Format the remaining time as mm:ss
            $formattedRemainingTime = sprintf('%02d:%02d', $remainingMinutes, $remainingSeconds);

            return response()->json([
                'status' => 'failed',
                'message' => 'Please try again after '.$formattedRemainingTime.' minutes',
                'remaining_time' => $formattedRemainingTime
            ], 200);
        }

        $user->otp = $otp;
        $user->expires_at = now()->addMinutes(5);
        $user->save();

        $response = Http::get('http://202.72.233.114/api/v2/SendSMS', [
            'ApiKey' => 'JlqIGVfWLOQHg2cUCWsjqc3jLG4TS0b7e6QWkk4MPnU=',
            'ClientId' => '303614b6-0888-4ec6-93cc-2eccfa162a75',
            'SenderId' => '8809617621857',
            'Message' => "Your OTP is $otp. Please use this code to complete your Registration. Do not share it with anyone.",
            'MobileNumbers' => "88$phone",
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Otp sent successfully',
            'phone' => $request->phone,
            'otp' => $otp,
            'expires_at' => $user->expires_at->format('Y-m-d H:i:s')
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'password' => 'required|confirmed',
            'phone' => 'required|digits:11|numeric',
        ]);

        $phone = $request->phone;

        $user = User::role('student')->where('phone', $phone)->first();

        if ($user) {
            $user->name = $request->name;
            $user->slug = Str::slug($request->name).uniqid();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone_verified = 1;
            $user->phone_verified_at = now();
            $save = $user->save();
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->slug = Str::slug($request->name).uniqid();
            $user->email = $request->email;
            $user->phone = $phone;
            $user->password = Hash::make($request->password);
            $user->phone_verified = 1;
            $user->phone_verified_at = now();

            $user->assignRole('student');
            $save = $user->save();
        }


        if ($save) {
            return response()->json([
                'status' => 'success',
                'message' => 'Student created successfully'
            ],
                200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not created'
            ], 404);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed'
        ]);

        $phone = $request->phone;

        $user = User::role('student')->where('phone', $phone)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $save = $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password reset successfully'
            ],
                200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'User not found'
            ],
                404);
        }
    }

    //Authentication Ends


    public function basicInfo()
    {
        $basicInfo = Basicinfo::first();

        if (!$basicInfo) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $basicInfo
        ], 200);
    }


    public function homeBannerData()
    {
        $bannerData = Herobanner::first();

        if (!$bannerData) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $bannerData
        ], 200);
    }

    public function homeCategoryData()
    {
        $categoryData = CourseClass::where('status', 1)->latest()->limit(8)->get();

        if ($categoryData->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $categoryData
        ], 200);
    }


    public function featuredCourseData()
    {
        $featuredData = Course::with(['class', 'teacher'])->withCount('lessons')->where('status',
            1)->where('is_featured', 1)->limit(6)->get();


        if ($featuredData->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $featuredData
        ], 200);
    }

    public function homeAboutData()
    {
        $homeAboutData = About::first();

        if (!$homeAboutData) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $homeAboutData
        ], 200);
    }

    public function homePopularCategoriesData()
    {
        $popularCategories = CourseClass::where('status', 1)->where('is_featured', 1)->limit(6)->get();

        if ($popularCategories->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $popularCategories
        ], 200);
    }

    public function homeCourseWithClass()
    {
        $courses = Course::with(['class', 'teacher'])->withCount('lessons')->where('status', 1)->limit(6)->get();
        $courseClasses = CourseClass::where('status', 1)->where('is_featured', 1)->orderBy('position',
            'asc')->limit(4)->get();


        if ($courses->isEmpty() && $courseClasses->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => [
                'classes' => $courseClasses,
                'courses' => $courses
            ]
        ], 200);
    }


    public function homeTeachersData()
    {
        $teachers = User::role('teacher')->where('status', 1)->limit(6)->get();

        if ($teachers->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $teachers
        ], 200);
    }


    public function homeTestimonialData()
    {
        $testimonials = Testimonial::where('status', 1)->get();
        $testimonialSetting = TestimonialSetting::first();

        if (!$testimonialSetting && $testimonials->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => [
                'testimonial' => $testimonials,
                'settings' => $testimonialSetting
            ]
        ], 200);
    }


    public function homeBlogData()
    {
        $blogs = Blog::where('status', 1)->latest()->limit(3)->get();


        if ($blogs->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $blogs
        ], 200);
    }


    //Footer Content

    public function footerUsefulLinks()
    {
        $pages = Page::where('status', 1)->limit(5)->get();

        if ($pages->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $pages
        ], 200);
    }

    public function footerCourses()
    {
        $courses = CourseClass::where('status', 1)->latest()->limit(5)->get();

        if ($courses->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $courses
        ], 200);
    }

    public function footerRecentPosts()
    {
        $blogs = Blog::where('status', 1)->latest()->limit(3)->get();

        if ($blogs->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $blogs
        ], 200);
    }


    //Courses
    public function courseList()
    {
        $courses = Course::where('status', 1)
            ->select('id', 'slug', 'title', 'teacher_id', 'thumbnail_img',
                'duration', 'regular_price', 'sale_price', 'discount')
            ->with('teacher', function ($q) {
                $q->select('id', 'name');
            })
            ->withCount('lessons')
            ->paginate(9);

        if ($courses->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $courses
        ], 200);
    }

    public function courseDetails(string $slug)
    {
        $courseDetails = Course::where('slug', $slug)
            ->with([
                'teacher' => function ($q) {
                    $q->select('id', 'name', 'profile_image', 'instructor_title',
                        'fb_link', 'youtube_link', 'insta_link', 'twitter_link');
                },
                'subjects' => function ($q) {
                    $q->select('id', 'title', 'slug', 'course_id', 'position');
                },
                'class'=>function ($q) {
                    $q->select('id', 'title', 'slug', 'position');
                },
            ])->withCount('lessons')->first();

        


        $subjects = Subject::where('course_id', $courseDetails->id)->where('status', 1)->orderBy('position', 'asc')
            ->with([
                'lessons' => function ($q) {
                    $q->orderBy('position', 'asc');
                },
                'lessons.lessonVideos' => function ($q) {
                    $q->orderBy('position', 'asc');
                },

//                'lessons.assessments' => function ($q) {
//                    $q->orderBy('position', 'asc');
//                },


            ])->get();

        if (!$courseDetails) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => [
                'course' => $courseDetails,
//                'enrollment' => $enrollment,
//                'subjects' => $subjects
            ]
        ], 200);
    }

    public function checkEnrollment(string $id)
    {
        $enrollment = Enrollment::where('user_id', auth()->user()->id ?? 0)->where('course_id',
            $id)->first();
        

        if (!$enrollment) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $enrollment
        ]);
    }

    //Teachers
    public function teacherList()
    {
        $teachers = User::role('teacher')->where('status', 1)
            ->select('id', 'slug', 'name', 'instructor_title', 'profile_image',
                'fb_link', 'youtube_link', 'insta_link', 'twitter_link')->paginate(9);


        if ($teachers->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $teachers
        ], 200);
    }


    public function teacherDetails(string $slug)
    {
        $teacherDetails = User::role('teacher')
            ->where('slug', $slug)
            ->first();

        $relatedCourses = Course::where('teacher_id', $teacherDetails->id)
            ->where('status', 1)
            ->limit(4)
            ->get();


        if (!$teacherDetails) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => [
                'teacher' => $teacherDetails,
                'relatedCourses' => $relatedCourses
            ]
        ], 200);
    }


    //blogs
    public function blogList()
    {
        $blogs = Blog::where('status', 1)
            ->with('author', function ($q) {
                $q->select('id', 'name');
            })
            ->select('id', 'slug', 'title', 'author_id', 'thumbnail_img', 'main_img', 'created_at', 'short_desc',
                'user_id')
            ->inRandomOrder()
            ->paginate(3);

        $recentBlog = Blog::where('status', 1)->latest()->limit(3)->get();


        if ($blogs->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' =>
                [
                    'blogs' => $blogs,
                    'recentBlog' => $recentBlog
                ]
        ], 200);
    }

    //blog details

    public function blogDetails(string $slug)
    {
        $blog = Blog::where('slug', $slug)->with('author')->first();
        $recentBlogs = Blog::where('status', 1)->latest()->take(4)->get();

        if (!$blog) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' =>
                [
                    'blog' => $blog,
                    'recentBlogs' => $recentBlogs
                ]
        ], 200);
    }


    //About Us
    public function aboutUsPage()
    {
        $aboutUs = Page::where('slug', 'about-us')->first();


        if (!$aboutUs) {
            return response()->json([
                'status' => 'error',
                'message' => 'data not found',
            ], 402);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'data found',
            'data' => $aboutUs
        ], 200);
    }

    //ChatGPT API
    public function chat(Request $request)
    {
        $response = Http::withHeaders([
            'content-type' => 'application/json',
            'Authorization' => "Bearer ".env('GPT_SECRET_KEY')

        ])->post('https://api.openai.com/v1/completions', [
            'model' => "gpt-3.5-turbo",
            'messages' => [
                [
                    "role" => "user",
                    "content" => $request->post('prompt')
                ]
            ],
            'temperature' => 0,
            'max_tokens' => 2048,
        ])->body();


        return response()->json(json_decode($response));
    }
}
