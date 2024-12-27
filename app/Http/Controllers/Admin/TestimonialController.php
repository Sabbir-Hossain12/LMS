<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
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
        return view('backend.pages.website.testimonials');
    }

    public function getData()
    {
        $testimonials = Testimonial::where('status', 1)->get();


        return DataTables::of($testimonials)
            ->addColumn('status', function ($testimonial) {

//                if(Auth::user()->can('Status Testimonial')) {
                    if ($testimonial->status == 1) {
                        return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$testimonial->id.'" data-status="'.$testimonial->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                    } else {
                        return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$testimonial->id.'" data-status="'.$testimonial->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';
                    }
//                }

            })
           
            ->addColumn('action', function ($testimonial) {

                $editAction = '';
                $deleteAction = '';

//                if(Auth::user()->can('Edit Testimonial')) {

                    $editAction= '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                    data-id="'.$testimonial->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                    <i class="fas fa-edit"></i></a>';

//                }

//                if(Auth::user()->can('Delete Testimonial')) {

                    $deleteAction= '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                    data-id="'.$testimonial->id.'" id="deleteAdminBtn""> 
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
        //
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
}
