<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.pages.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $classes=CourseClass::where('status',1)->get();
        $teachers= User::role('teacher')->where('status',1)->get();
        return view('backend.pages.courses.create',compact('classes','teachers'));
    }

    public function getData()
    {
        $courses = Course::get();
        

        return  DataTables::of($courses)
            ->addColumn('status', function ($course) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                if ($course->status == 1) {
                    return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$course->id.'" data-status="'.$course->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {

                    return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$course->id.'" data-status="'.$course->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                }
//                }

            })

            ->addColumn('featured_status', function ($course) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                if ($course->is_featured == 1) {
                    return ' <a class="fStatus" id="featuredStatus" href="javascript:void(0)"
                                               data-id="'.$course->id.'" data-status="1"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {

                    return '<a class="fStatus" id="featuredStatus" href="javascript:void(0)"
                                               data-id="'.$course->id.'" data-status="0"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                }
//                }

            })

            ->addColumn('action', function ($course) {

                $editAction = '<a class="editButton btn btn-sm btn-primary" href="'.route('admin.course.edit', $course->id).'">
                                   <i class="fas fa-edit"></i></a>';
                $deleteAction = '<a class="btn btn-sm btn-danger" id="deleteAdminBtn" data-id="'.$course->id.'" href="javascript:void(0)"> 
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
                
//                return '<div class="btn-group" role="group">
//                                                    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
//                                                        Actions <i class="mdi mdi-chevron-down"></i>
//                                                    </button>
//                                                   <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 40px, 0px);" data-popper-placement="bottom-start">
//                                                        '.$editAction.$deleteAction.$subjectAction.'
//                                                    </div>
//                                                </div>';


            })
            ->rawColumns(['action', 'status','featured_status'])
            ->make(true);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request->all());
//        $request->validate([
//            'course_class_id ' => 'required',
//            'teacher_id' => 'integer',
//            'title' => 'required | string',
//            'short_desc' => 'required | string',
//            'long_desc' => 'required | string',
//            'details_img' => 'required',
//            'thumbnail_img' => 'required',
//            'duration' => 'string',
//            'regular_price' => 'integer',
//            'sale_price' => 'integer',
//            'discount' => 'integer',
//            'is_featured' => 'integer',
//            'is_exam' => 'integer',
//            'is_certificate' => 'integer',
//            'status' => 'integer',
//            
//        ]);
        
        
        $course = new Course();
        $course->course_class_id = $request->course_class_id;
        $course->teacher_id = $request->teacher_id;
        $course->title = $request->title;
        $course->slug = Str::slug($request->title).uniqid();
        $course->short_desc = $request->short_desc;
        $course->long_desc = $request->long_desc;
        $course->duration = $request->duration;
        $course->regular_price = $request->regular_price;
        $course->sale_price = $request->sale_price;
        $course->discount = $request->discount;
        $course->is_featured = $request->is_featured;
        $course->is_exam = $request->is_exam;
        $course->is_certificate = $request->is_certificate;
        $course->status = $request->status;
        
        $course->meta_title = $request->meta_title;
        $course->meta_desc = $request->meta_desc;
        $course->meta_keywords = $request->meta_keywords;
        
        if ($request->hasFile('meta_img')) {
            $file = $request->file('meta_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/courses/'), $filename);
            $course->meta_img ='backend/uploads/courses/'. $filename;
        }
        
        
        
        if ($request->hasFile('details_img')) {
            $file = $request->file('details_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/courses/'), $filename);
            $course->details_img ='backend/upload/courses/'. $filename;
        }
        
        if ($request->hasFile('thumbnail_img')) {
            $file = $request->file('thumbnail_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/courses/'), $filename);
            $course->thumbnail_img ='backend/upload/courses/'. $filename;
        }
        
        
        
        $save=  $course->save();


        if ($save) {
            return redirect()->route('admin.course.index')->with('success', 'Course created successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
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
        $classes=CourseClass::where('status',1)->get();
        $teachers= User::role('teacher')->where('status',1)->get();
        $course = Course::find($id);

        return view('backend.pages.courses.edit', compact('course','classes','teachers'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        dd($request->all());
//        $request->validate([
//            'course_class_id ' => 'required',
//            'teacher_id' => 'nullable | integer',
//            'title' => 'required | string',
//            'short_desc' => 'required | string',
//            'long_desc' => 'required | string',
//            'details_img' => 'required',
//            'thumbnail_img' => 'required',
//            'duration' => 'string',
//            'regular_price' => 'integer',
//            'sale_price' => 'integer',
//            'discount' => 'integer',
//            'is_featured' => 'integer',
//            'is_exam' => 'integer',
//            'is_certificate' => 'integer',
//            'status' => 'integer',
//
//        ]);


        $course = Course::find($id);
        $course->course_class_id = $request->course_class_id;
        $course->teacher_id = $request->teacher_id;
        $course->title = $request->title;
        $course->short_desc = $request->short_desc;
        $course->long_desc = $request->long_desc;
        $course->duration = $request->duration;
        $course->regular_price = $request->regular_price;
        $course->sale_price = $request->sale_price;
        $course->discount = $request->discount;
        $course->is_featured = $request->is_featured;
        $course->is_exam = $request->is_exam;
        $course->is_certificate = $request->is_certificate;
        $course->status = $request->status;

        $course->meta_title = $request->meta_title;
        $course->meta_desc = $request->meta_desc;
        $course->meta_keywords = $request->meta_keywords;
        
        if ($request->hasFile('details_img')) {
            if ($course->details_img && file_exists(public_path($course->details_img))) {
                unlink(public_path($course->details_img));
            }
            $file = $request->file('details_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/courses/'), $filename);
            $course->details_img ='backend/upload/courses/'. $filename;
        }
        
        if ($request->hasFile('thumbnail_img')) {
            if ($course->thumbnail_img && file_exists(public_path($course->thumbnail_img))) {
                unlink(public_path($course->thumbnail_img));
            }
            $file = $request->file('thumbnail_img');
            $filename = time().uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('backend/upload/courses/'), $filename);
            $course->thumbnail_img ='backend/upload/courses/'. $filename;
        }

        
 

        $save=  $course->save();


        if ($save) {
            return redirect()->route('admin.course.index')->with('success', 'Course Updated successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        if ($course) {
            $course->delete();

            return response()->json(['status' => 'success','message' => 'Course Deleted successfully'], 200);
        }
        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }
    
    public function changeCourseStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = Course::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }


    public function changeFeaturedCourseStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = Course::findOrFail($id);
        $page->is_featured = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
