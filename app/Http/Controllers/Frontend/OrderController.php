<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\OrderCourse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkoutPage(string $slug)
    {
        
        $course = Course::where('slug', $slug)->first();
        return view('Frontend.pages.checkout.checkout-page', compact('course'));
        
    }


    public function orderSubmit(Request $request)
    {
        
//        dd($request->all());


        DB::beginTransaction();
        try {
            
            $course= Course::find($request->course_id);
            
            $student_id=auth()->user()->id;
            
            $student= User::find($student_id);
            $student->name=$request->name;
            $student->email=$request->email;
            $student->address=$request->address;
            $student->save();
            
           
            $order= new Order();
            $order->user_id = auth()->user()->id;
            $order->total_amount = $course->sale_price;
            $order->transaction_id = uniqid();
            $order->save();
            
            
            
            $orderCourse= new OrderCourse();
            $orderCourse->order_id = $order->id;
            $orderCourse->course_id = $request->course_id;
            $orderCourse->price = $course->sale_price;
            $orderCourse->discount = $course->discount ?? 0;
            $orderCourse->save();
            
            
            $enrollment= new Enrollment();
            $enrollment->user_id = auth()->user()->id;
            $enrollment->course_id = $request->course_id;
            $enrollment->order_id = $order->id;
            $enrollment->save();
            
            
            DB::commit();
            return redirect()->route('student.dashboard.index')->with('success', 'Course Enrolled Successfully');
            
        }
        
        catch (Exception $e) {
            
            DB::rollBack();
            dd($e->getMessage());
            
        }
    }
    
}
