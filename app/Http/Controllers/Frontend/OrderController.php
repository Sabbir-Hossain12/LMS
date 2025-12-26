<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\OrderCourse;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function checkoutPage(string $slug)
    {
        $course = Course::where('slug', $slug)->first();

        if ($course->product_type == 'course') {
            if (!Auth::check() || !auth()->user()->hasRole('student')) {
                return redirect()->route('student.phone-page');
            }
        }

        return view('Frontend.pages.checkout.checkout-page', compact('course'));
    }

    public function checkoutBooksPage()
    {
        if (!Auth::check() || !auth()->user()->hasRole('student')) {
            return redirect()->route('student.phone-page');
        }

        $cartItems = Cart::where('user_id', auth()->id())->get();

        return view('Frontend.pages.checkout.checkout-books', compact('cartItems'));
    }


    public function orderSubmit(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'phone' => ['required', 'digits:11'],
        ]);


        DB::beginTransaction();
        try {
            $course = Course::find($request->course_id);
            $delivery_charge = $request->delivery_charge ?? 0;
            $qty = $request->qty ?? 1;


            if ($course->product_type == 'course') {
                if (!Auth::check() || !auth()->user()->hasRole('student')) {
                    return redirect()->route('student.phone-page');
                }
            }


            if (session()->has('coupon')) {
                $coupon = session('coupon');
                if ($coupon['course_id'] == $course->id) {
                    if ($coupon['type'] == 'Percentage') {
                        $couponAmount = ($course->sale_price * $coupon['discount']) / 100;
                        $course_price = $qty * $course->sale_price - $couponAmount + $delivery_charge;
                    } else {
                        $couponAmount = $coupon['discount'];
                        $course_price = $qty * $course->sale_price - $couponAmount + $delivery_charge;
                    }
                }
            }


            $invoiceNumber = uniqid();

            $student_id = auth()->id() ?? null;

// Try to find existing user by ID, else by email+phone
            if ($student_id) {
                $student = User::find($student_id);
            } else {
                $student = User::Where('phone', $request->phone)
                    ->first();
            }

            if ($student) {
                // Update existing user
                $student->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'district' => $request->district,
                    'thana' => $request->thana,
                    'area' => $request->area,
                    'holding_number' => $request->holding_number,
                ]);
            } else {
                // Create new user safely
                $student = User::create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'district' => $request->district,
                    'thana' => $request->thana,
                    'area' => $request->area,
                    'holding_number' => $request->holding_number,
                    'password' => Hash::make(random_int(100000, 999999)),
                    'phone_verified' => 1,
                    'phone_verified_at' => now(),
                ]);

                // Assign role after creation
                $student->assignRole('student');
            }


            $order = new Order();
            $order->user_id = $student->id ?? null;
            $order->total_amount = $course_price ?? ($qty * $course->sale_price + $delivery_charge);
            $order->transaction_id = $invoiceNumber;
            $order->payment_method = $request->payment_method;
            $order->product_type = $course->product_type;
            $order->delivery_charge = $delivery_charge;
            $order->discount = $couponAmount ?? 0;


            if ($request->payment_method == 'free') {
                $order->status = 'success';
            }

            $order->save();

            $orderCourse = new OrderCourse();
            $orderCourse->order_id = $order->id;
            $orderCourse->course_id = $request->course_id;
            $orderCourse->qty = $qty;
            $orderCourse->price = $course_price ?? $course->sale_price;
            $orderCourse->discount = $course->discount ?? $coupon['discount'];
            $orderCourse->save();

            DB::commit();

            if ($course->sale_price == 0) {
                $enrollment = new Enrollment();
                $enrollment->user_id = $student_id;
                $enrollment->course_id = $course->id;
                $enrollment->order_id = $order->id;
                $enrollment->save();

                return redirect()->route('student.dashboard.index')->with('success', 'Course Enrolled Successfully');
            }

            if ($order->payment_method == 'cod') {
                // return redirect()->route('home')->with('success', 'Book Ordered Successfully');

                return redirect()->route('order-sucess')->with('success', 'Book Ordered Successfully');
            }

            $request['intent'] = 'sale';
            $request['mode'] = '0011'; //0011 for checkout
            $request['payerReference'] = $invoiceNumber;
            $request['currency'] = 'BDT';
            $request['amount'] = $course_price ?? ($qty * $course->sale_price + $delivery_charge);
            $request['merchantInvoiceNumber'] = $invoiceNumber;
            $request['callbackURL'] = config("bkash.callbackURL");


            Session::put('course_id', $request->course_id);

            $request_data_json = json_encode($request->all());

            $response = BkashPaymentTokenize::cPayment($request_data_json);
            // dd(json_encode($response)); //if you are using sandbox and not submit info to bkash use it for 1 response


            if (isset($response['bkashURL'])) {
                return redirect()->away($response['bkashURL']);
            } else {
                return redirect()->back()->with('error-alert2', $response['statusMessage']);
            }
        } catch (Exception $e) {
            DB::rollBack();


            dd($e->getMessage());
        }
    }

    public function orderSubmitBooks(Request $request)
    {
//      dd($request->all());

        $request->validate([
            'phone' => ['required', 'digits:11'],
        ]);


        DB::beginTransaction();
        try {
            $student_id = auth()->id() ?? null;
            $delivery_charge = $request->delivery_charge ?? 0;
            $cartItems = Cart::where('user_id', auth()->id())->get();
            $totalAmount = $cartItems->sum('total') + $delivery_charge ;

            $invoiceNumber = uniqid();

            // Try to find existing user by ID, else by email+phone
            if ($student_id) {
                $student = User::find($student_id);
            } else {
                $student = User::Where('phone', $request->phone)
                    ->first();
            }

            if ($student) {
                // Update existing user
                $student->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'district' => $request->district,
                    'thana' => $request->thana,
                    'area' => $request->area,
                    'holding_number' => $request->holding_number,
                ]);
            } else {
                // Create new user safely
                $student = User::create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'district' => $request->district,
                    'thana' => $request->thana,
                    'area' => $request->area,
                    'holding_number' => $request->holding_number,
                    'password' => Hash::make(random_int(100000, 999999)),
                    'phone_verified' => 1,
                    'phone_verified_at' => now(),
                ]);

                // Assign role after creation
                $student->assignRole('student');
            }

            $order = new Order();
            $order->user_id = $student->id ?? null;
            $order->total_amount = $totalAmount;
            $order->transaction_id = $invoiceNumber;
            $order->payment_method = $request->payment_method;
            $order->product_type = "book";
            $order->delivery_charge = $delivery_charge;
            $order->discount = 0;
            $order->save();

            foreach ($cartItems as $cartItem) {
                $orderCourse = new OrderCourse();
                $orderCourse->order_id = $order->id;
                $orderCourse->course_id = $cartItem->course_id;
                $orderCourse->qty = $cartItem->quantity;
                $orderCourse->price = $cartItem->price;
                $orderCourse->discount = 0;
                $orderCourse->save();
            }

            DB::commit();

            $cartItems->each->delete();

            if ($order->payment_method == 'cod') {
                // return redirect()->route('home')->with('success', 'Book Ordered Successfully');

                return redirect()->route('order-sucess')->with('success', 'Book Ordered Successfully');
            }

            $request['intent'] = 'sale';
            $request['mode'] = '0011'; //0011 for checkout
            $request['payerReference'] = $invoiceNumber;
            $request['currency'] = 'BDT';
            $request['amount'] = $totalAmount ;
            $request['merchantInvoiceNumber'] = $invoiceNumber;
            $request['callbackURL'] = config("bkash.callbackURL");

            $request_data_json = json_encode($request->all());

            $response = BkashPaymentTokenize::cPayment($request_data_json);
            // dd(json_encode($response)); //if you are using sandbox and not submit info to bkash use it for 1 response

            if (isset($response['bkashURL'])) {
                return redirect()->away($response['bkashURL']);
            } else {
                return redirect()->back()->with('error-alert2', $response['statusMessage']);
            }
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Payment failed', ['exception' => $e]);

            return redirect()->back()->with('error', $response['statusMessage']);
        }
    }


    public function applyCoupon(Request $request)
    {
        $course_id = $request->course_id;
        $coupon = Coupon::where('code', $request->code)
            ->where('course_id', $course_id)
            ->where('status', 1)
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.'
            ]);
        }

        // Optional: validate expiry, usage limit, etc.
        if ($coupon->used_count >= $coupon->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid coupon code.'
            ]);
        }

        Session::put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->discount_type,
            'discount' => $coupon->discount_value,
            'course_id' => $coupon->course_id// percentage or fixed
        ]);

        return response()->json([
            'success' => true,
            'discount' => $coupon->discount_value,
            'type' => $coupon->discount_type
        ]);
    }

}
