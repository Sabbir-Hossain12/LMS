<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\OrderCourse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrolmentController extends Controller
{
    public function index(string $id)
    {
        $course=Course::find($id);
        $students= User::role('student')->where('status',1)->get();
        $enrolments= Enrollment::where('course_id', $id)->with('student')->get();
        
        return view('backend.pages.enrolment.index',compact('course','students','enrolments'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//      dd($request->all());
        
        $inv_num= uniqid();
        $course= Course::find($request->course_id);

        $order= new Order();
        $order->user_id = $request->user_id;
        $order->total_amount = $course->sale_price;
        $order->transaction_id = $inv_num;
        $order->save();
        
        $orderCourse= new OrderCourse();
        $orderCourse->order_id = $order->id;
        $orderCourse->course_id = $request->course_id;
        $orderCourse->price = $course->sale_price;
        $orderCourse->discount = $course->discount ?? 0;
        $orderCourse->save();

        $enrollment= new Enrollment();
        $enrollment->user_id = $request->user_id;
        $enrollment->course_id = $request->course_id;
        $enrollment->order_id = $order->id;
        $enrollment->save();
        
        return redirect()->back()->with('success','Enrolled Successful');
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyEnrolment(string $id)
    {


        DB::beginTransaction();

        try {
            $enrollment = Enrollment::find($id);

            if (!$enrollment) {
                return redirect()->back()->with('error', 'Enrollment not found.');
            }

            // Delete the enrollment record
            $enrollment->delete();

            // Delete related records
            OrderCourse::where('order_id', $enrollment->order_id)->delete();
            Order::where('id', $enrollment->order_id)->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete. Please try again.');
        }
    }
}
