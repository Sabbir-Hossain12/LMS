<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderCourse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;

class OrderController extends Controller
{
    public function checkoutPage(string $slug)
    {
        
        $course = Course::where('slug', $slug)->first();
        return view('Frontend.pages.checkout.checkout-page', compact('course'));
        
    }


    public function orderSubmit(Request $request)
    {
        
        
        // dd($request->all());


        DB::beginTransaction();
        try {
            
            $course= Course::find($request->course_id);
            
            
              if(session()->has('coupon')) {
             
                $coupon = session('coupon');
                
                if($coupon['type'] == 'Percentage')
                {
                  $course_price =  $course->sale_price - ($course->sale_price * $coupon['discount'])/100;
                }
                
                else
                {
                    $course_price =  $course->sale_price - $coupon['discount'] ;
                }
            }
            
           
            
            
            
            
            $student_id=auth()->user()->id;
            
            $invoiceNumber=uniqid();
            
            $student= User::find($student_id);
            $student->name=$request->name;
            $student->email=$request->email;
            $student->address=$request->address;
            $student->save();
            
           
            $order= new Order();
            $order->user_id = auth()->user()->id;
            $order->total_amount = $course_price ?? $course->sale_price;
            $order->transaction_id = $invoiceNumber;
            $order->payment_method	 = $request->payment_method;
            
            if($request->payment_method == 'free')
            {
                $order->status = 'success';
            }
            
            $order->save();
            
            $orderCourse= new OrderCourse();
            $orderCourse->order_id = $order->id;
            $orderCourse->course_id = $request->course_id;
            $orderCourse->price = $course_price ?? $course->sale_price;
            $orderCourse->discount = $course->discount ?? $coupon['discount'];
            $orderCourse->save();
            
            DB::commit();
            
            if($course->sale_price == 0)
            {
                    $enrollment= new Enrollment();
                    $enrollment->user_id = $student_id;
                    $enrollment->course_id = $course->id;
                    $enrollment->order_id = $order->id;
                    $enrollment->save();
              
                return redirect()->route('student.dashboard.index')->with('success', 'Course Enrolled Successfully');
            }
            
            $request['intent'] = 'sale';
            $request['mode'] = '0011'; //0011 for checkout
            $request['payerReference'] = $invoiceNumber;
            $request['currency'] = 'BDT';
            $request['amount'] = $course_price ?? $course->sale_price;
            $request['merchantInvoiceNumber'] = $invoiceNumber;
            $request['callbackURL'] = config("bkash.callbackURL");
            
            

            Session::put('course_id', $request->course_id);
            
            $request_data_json = json_encode($request->all());

            $response =  BkashPaymentTokenize::cPayment($request_data_json);
            // dd(json_encode($response)); //if you are using sandbox and not submit info to bkash use it for 1 response


            if (isset($response['bkashURL']))
            {
                return redirect()->away($response['bkashURL']);
            }
            
            else
            {
                return redirect()->back()->with('error-alert2', $response['statusMessage']);
            }
            
            
        }
        
        catch (Exception $e) {
            
            DB::rollBack();
            dd($e->getMessage());
            
        }
    }
    
    
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)->first();

    if (!$coupon) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid coupon code.'
        ]);
    }

    // Optional: validate expiry, usage limit, etc.
    if($coupon->used_count >= $coupon->usage_limit )
    {
         return response()->json([
        'success' => false,
        'message' => 'Invalid coupon code.'
    ]);
    }
    
    Session::put('coupon', [
        'code' => $coupon->code,
        'type' => $coupon->discount_type,
        'discount' => $coupon->discount_value, // percentage or fixed
    ]);

    return response()->json([
        'success' => true,
        'discount' => $coupon->discount_value,
        'type' => $coupon->discount_type
    ]);
    }
    
}
