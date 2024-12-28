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
        $testimonials = Testimonial::all();


        return DataTables::of($testimonials)
            ->addColumn('status', function ($testimonial) {

//                if(Auth::user()->can('Status Testimonial')) {
                    if ($testimonial->status == 1) {
                        return ' <a class="status" id="testimonialStatus" href="javascript:void(0)"
                                               data-id="'.$testimonial->id.'" data-status="'.$testimonial->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                    } else {
                        return '<a class="status" id="testimonialStatus" href="javascript:void(0)"
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
                                    data-id="'.$testimonial->id.'" data-bs-toggle="modal" data-bs-target="#editTestimonialFormModal">
                                    <i class="fas fa-edit"></i></a>';

//                }

//                if(Auth::user()->can('Delete Testimonial')) {

                    $deleteAction= '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                    data-id="'.$testimonial->id.'" id="deleteTestimonialBtn""> 
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
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $testimonial= new Testimonial();
        
        $testimonial->name=$request->name;
        $testimonial->title=$request->title;
        $testimonial->desc=$request->desc;
        
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/testimonials/'), $filename);
            $testimonial->img = 'backend/uploads/testimonials/' .$filename;
        }
        
        $save = $testimonial->save();
        
        if ($save) {
            return response()->json(['status'=>'success', 'message' => 'Testimonial added successfully'],200);
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
        $testimonial = Testimonial::find($id);
        
        if ($testimonial) {
            return response()->json(['status'=>'success', 'data' => $testimonial],200);
        }
        
        return response()->json(['status'=>'failed','message' => 'Something went wrong'],500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'desc' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        
        $testimonial= Testimonial::find($id);
        
        $testimonial->name=$request->name;
        $testimonial->title=$request->title;
        $testimonial->desc=$request->desc;
        
        if ($request->hasFile('img')) {
            
            
            if ($testimonial->img && file_exists(public_path($testimonial->img))) {
                
                unlink(public_path($testimonial->img));
                
            }
            
            $file = $request->file('img');
            $filename = time() .uniqid(). '.' . $file->getClientOriginalExtension();
            $file->move(public_path('backend/uploads/testimonials/'), $filename);
            $testimonial->img = 'backend/uploads/testimonials/' .$filename;
        }
        
        $save = $testimonial->save();
        
        if ($save) {
            return response()->json(['status'=>'success', 'message' => 'Testimonial updated successfully'],200);
        }
        return response()->json(['status'=>'failed','message' => 'Something went wrong'],500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);
        
        if ($testimonial->img && file_exists(public_path($testimonial->img))) {
            unlink(public_path($testimonial->img));
        }
        
        
        $delete = $testimonial->delete();
        
        if ($delete) {
            return response()->json(['status'=>'success', 'message' => 'Testimonial deleted successfully'],200);
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

        $page = Testimonial::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
