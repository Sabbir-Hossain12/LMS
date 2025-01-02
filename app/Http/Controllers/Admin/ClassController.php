<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends Controller
{
    public function index()
    {
        return view('backend.pages.class.index');
    }

    public function getData()
    {
        $classes = CourseClass::get();

//        dd($admins);

        return   DataTables::of($classes)
            ->addColumn('status', function ($class) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                if ($class->status == 1) {
                    return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$class->id.'" data-status="'.$class->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {

                    return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$class->id.'" data-status="'.$class->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                }
//                }

            })

            ->addColumn('featured_status', function ($class) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                if ($class->is_featured == 1) {
                    return ' <a class="fStatus" id="featuredStatus" href="javascript:void(0)"
                                               data-id="'.$class->id.'" data-status="1"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {

                    return '<a class="fStatus" id="featuredStatus" href="javascript:void(0)"
                                               data-id="'.$class->id.'" data-status="0"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                }
//                }

            })

            ->addColumn('action', function ($class) {

                $editAction = '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                  data-id="'.$class->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                   <i class="fas fa-edit"></i></a>';
                $deleteAction = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$class->id.'" id="deleteAdminBtn""> 
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
            ->rawColumns(['action', 'status','featured_status'])
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
//      dd($request->all());
        $class = new CourseClass();
        $class->title = $request->title;
        $class->subtitle = $request->subtitle;
        $class->slug = Str::slug($request->title).uniqid();
        $class->desc = $request->desc;
        $class->icon = $request->icon;
        $class->position = $request->position;
        
        if ($request->hasFile('img')) {

            $file = $request->file('img');
            $filename = time().uniqid().$file->getClientOriginalName();
            $file->move(public_path('backend/upload/class/'), $filename);
            $class->img ='backend/upload/class/'. $filename;

        }

        $save= $class->save();

        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Class created successfully'], 201);
        }
        
        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);

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
      
        $class = CourseClass::findOrFail($id);


        if ($class) {
            return response()->json(['status' => 'success','message' => 'Class fetched successfully', 'data' => $class], 200);
        }

        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//      dd($request->all());
        $class =CourseClass::findOrFail($id);
        $class->title = $request->title;
        $class->subtitle = $request->subtitle;
        $class->desc = $request->desc;
        $class->icon = $request->icon;
        $class->position = $request->position;

        if ($request->hasFile('img')) {
            
            if ($class->img && file_exists(public_path($class->img))) {
                unlink(public_path($class->img));
            }

            $file = $request->file('img');
            $filename = time().uniqid().$file->getClientOriginalName();
            $file->move(public_path('backend/upload/class/'), $filename);
            $class->img ='backend/upload/class/'. $filename;

        }

        $save= $class->save();

        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Class created successfully'], 201);
        }

        return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = CourseClass::findOrFail($id);

        if ($admin) {
            $admin->delete();

            return response()->json(['status' => 'success','message' => 'Class Deleted successfully'], 200);
        }
        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    public function changeClassStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = CourseClass::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }


    public function changeFeaturedClassStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = CourseClass::findOrFail($id);
        $page->is_featured = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
