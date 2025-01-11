<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\OrderCourse;
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
           
            $order= new Order();
            $order->user_id = auth()->user()->id;
            $order->total_amount = $course->sale_price;
            $order->transaction_id = uniqid();
            
            $order->save();
            
            
            
            
            $orderCourse= new OrderCourse();
            
            $orderCourse->order_id = $order->id;
            $orderCourse->course_id = $request->course_id;
            $orderCourse->save();
            
            DB::commit();
            
        }
        
        catch (Exception $e) {
            
        }
    }
    
}
