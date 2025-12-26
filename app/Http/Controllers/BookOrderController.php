<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderCourse','orderCourse.course')
            ->where('product_type','book')
             ->where(function($query) {
        $query->where(function($q) {
            // COD: all statuses
            $q->where('payment_method', 'cod');
        })
        ->orWhere(function($q) {
            // Bkash: only success
            $q->where('payment_method', 'bkash')
              ->where('status', 'success');
        });
    })
            ->latest()
            ->get();

        return view('backend.pages.orders.book.index',compact('orders'));
    }

    public function getData()
    {

        $orders = Order::with('orderCourse')
            ->where('status', 'success')
            ->latest();

        return   DataTables::of($orders)

            ->addColumn('action', function ($order) {

                $editAction = '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                  data-id="'.$order->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                   <i class="fas fa-edit"></i></a>';
                $deleteAction = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$order->id.'" id="deleteAdminBtn"">
                                   <i class="fas fa-trash"></i></a>';

//              if(Auth::guard('admin')->user()->can('Edit Admin')) {
//
//                  $editAction= '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
//                                    data-id="'.$admin->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
//                                    <i class="fas fa-edit"></i></a>';
//
//              }
//
//              if(Auth::guard('admin')->user()->can('Delete Admin')) {
//
//                  $deleteAction= '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
//                                    data-id="'.$admin->id.'" id="deleteAdminBtn"">
//                                    <i class="fas fa-trash"></i></a>';
//
//              }

                return '<div class="d-flex gap-3"> '.$editAction.$deleteAction.'</div>';


            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('orderCourses','orderCourses.course')
            ->where('product_type','book')
            ->where('id',$id)
            ->first();


        return view('backend.pages.orders.book.view',compact('order'));
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
    public function destroy(string $id)
    {
        //
    }

    public function changeBookOrderStatus(Request $request)
    {
         $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = Order::findOrFail($id);
        $page->isActive = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
