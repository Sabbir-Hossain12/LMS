<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
//    implements HasMiddleware
{
//    public static function middleware(): array
//    {
//        return [
//
//            new Middleware('permission:View Admin', only: ['index']),
//            new Middleware('permission:Create Admin', only: ['store']),
//            new Middleware('permission:Edit Admin', only: ['update']),
//            new Middleware('permission:Delete Admin', only: ['destroy']),
//            new Middleware('permission:Status Admin', only: ['changeAdminStatus']),
//
//        ];
//    }
    public function index()
    {
        return view('backend.pages.coupons.index');
    }

    public function getData()
    {
        $coupons = Coupon::all();


        return DataTables::of($coupons)
            ->addColumn('status', function ($coupon) {

//                if(Auth::user()->can('Status Testimonial')) {
                    if ($coupon->status == 1) {
                        return ' <a class="status" id="testimonialStatus" href="javascript:void(0)"
                                               data-id="'.$coupon->id.'" data-status="'.$coupon->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                    } else {
                        return '<a class="status" id="testimonialStatus" href="javascript:void(0)"
                                               data-id="'.$coupon->id.'" data-status="'.$coupon->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';
                    }
//                }

            })
           
            ->addColumn('action', function ($coupon) {

                $editAction = '';
                $deleteAction = '';

//                if(Auth::user()->can('Edit Testimonial')) {

                    $editAction= '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                    data-id="'.$coupon->id.'" data-bs-toggle="modal" data-bs-target="#editTestimonialFormModal">
                                    <i class="fas fa-edit"></i></a>';

//                }

//                if(Auth::user()->can('Delete Testimonial')) {

                    $deleteAction= '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                    data-id="'.$coupon->id.'" id="deleteTestimonialBtn""> 
                                    <i class="fas fa-trash"></i></a>';

//                }

                return '<div class="d-flex gap-3"> '.$editAction.$deleteAction.'</div>';


            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        
        $coupon = new Coupon();
        
        $coupon->code   = $request->code;
        $coupon->description = $request->description;
        $coupon->discount_type  = $request->discount_type;
        $coupon->discount_value  = $request->discount_value;
        
        $coupon->usage_limit  = $request->usage_limit;
        // $coupon->used_count  = $request->used_count;
        
        
        
        $save = $coupon->save();
        
        if ($save) {
            return response()->json(['status'=>'success', 'message' => 'Coupon added successfully'],200);
        }
        return response()->json(['status'=>'failed','message' => 'Something went wrong'],500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        
        if ($coupon) {
            return response()->json(['status'=>'success', 'data' => $coupon],200);
        }
        
        return response()->json(['status'=>'failed','message' => 'Something went wrong'],500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $coupon= Coupon::find($id);
        
        $coupon->code   = $request->code;
        $coupon->description = $request->description;
        $coupon->discount_type  = $request->discount_type;
        $coupon->discount_value  = $request->discount_value;
        
        $coupon->usage_limit  = $request->usage_limit;
        // $coupon->used_count  = $request->used_count;
      
        
        $save = $coupon->save();
        
        if ($save) {
            return response()->json(['status'=>'success', 'message' => 'Coupon updated successfully'],200);
        }
        return response()->json(['status'=>'failed','message' => 'Something went wrong'],500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        
        $delete = $coupon->delete();
        
        if ($delete) {
            return response()->json(['status'=>'success', 'message' => 'Coupon deleted successfully'],200);
        }
        
        return response()->json(['status'=>'failed','message' => 'Something went wrong'],500);
    }


    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;


        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = Coupon::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
