<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index()
    {
        $roles = Role::get();
//        dd($roles);
        return view('backend.pages.student.index',compact('roles'));
    }
    

    public function getData()
    {
        $students = User::role('student')->get();

//        dd($admins);

        return   DataTables::of($students)
            ->addColumn('status', function ($student) {

//                if(Auth::guard('admin')->user()->can('Status Admin')) {
                if ($student->status == 1) {
                    return ' <a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$student->id.'" data-status="'.$student->status.'"> <i
                                                        class="fa-solid fa-toggle-on fa-2x"></i>
                                            </a>';
                } else {

                    return '<a class="status" id="adminStatus" href="javascript:void(0)"
                                               data-id="'.$student->id.'" data-status="'.$student->status.'"> <i
                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
                                            </a>';

                }
//                }

            })
            ->addColumn('role', function ($student) {
                $role = $student->getRoleNames();
//                $string = implode(',', $role);

                if (count($role)) {
                    return   '<span class="badge bg-success">'.$role[0].'</span>' ;
                }
                return '';
            })
            ->addColumn('action', function ($student) {

                $editAction = '<a class="editButton btn btn-sm btn-primary" href="javascript:void(0)"
                                  data-id="'.$student->id.'" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                   <i class="fas fa-edit"></i></a>';
                $deleteAction = '<a class="btn btn-sm btn-danger" href="javascript:void(0)"
                                   data-id="'.$student->id.'" id="deleteAdminBtn""> 
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
            ->rawColumns(['action', 'status', 'role'])
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
        $admin = new User();
        $admin->name = $request->name;
        $admin->slug =  Str::slug($request->name).uniqid();
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password = $request->password;
        
        
        
        $admin->assignRole('student');
        
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');
            $filename = time().uniqid().$file->getClientOriginalName();
            $file->move(public_path('backend/upload/student/'), $filename);
            $admin->profile_image ='backend/upload/student/'. $filename;

        }

        $save= $admin->save();

        if ($save) {
            return response()->json(['status' => 'success', 'message' => 'Student created successfully'], 201);
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
        $roles = Role::get();
        $admin = User::with('roles')->findOrFail($id);


        if ($admin) {
            return response()->json(['status' => 'success','message' => 'Student fetched successfully', 'data' => $admin, 'roles' => $roles], 200);
        }

        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//      dd($request->all());
        $admin = User::findOrFail($id);

        if ($admin) {
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
//            $admin->password = Hash::make($request->password);

            $admin->syncRoles($request->role);

            if ($request->hasFile('profile_image')) {
                if ($admin->profile_image && file_exists(public_path($admin->profile_image))) {
                    unlink(public_path($admin->profile_image));
                }
                $file = $request->file('profile_image');
                $filename = time().uniqid().$file->getClientOriginalName();
                $file->move(public_path('backend/upload/student/'), $filename);
                $admin->profile_image ='backend/upload/student/'. $filename;
            }

            $save= $admin->save();

            if ($save) {
                return response()->json(['status' => 'success','message' => 'Student fetched successfully'], 200);
            }
        }


        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);

        if ($admin) {
            $admin->delete();

            return response()->json(['status' => 'success','message' => 'Student Deleted successfully'], 200);
        }
        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    public function changeStudentStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        if ($status == 1) {
            $stat = 0;
        } else {
            $stat = 1;
        }

        $page = User::findOrFail($id);
        $page->status = $stat;
        $page->save();

        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
    }
}
