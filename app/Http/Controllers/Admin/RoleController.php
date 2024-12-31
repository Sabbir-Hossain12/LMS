<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get();


        return view('backend.pages.role.index', compact('roles'));
    }

    public function getData()
    {
        $roles = Role::all();
        
//        dd($roles);


        return DataTables::of($roles)
//            ->addColumn('status', function ($admin) {
//                if ($admin->status == 1) {
//                    return ' <a class="status" id="adminStatus" href="javascript:void(0)"
//                                               data-id="'.$admin->id.'" data-status="'.$admin->status.'"> <i
//                                                        class="fa-solid fa-toggle-on fa-2x"></i>
//                                            </a>';
//                } else {
//                    return '<a class="status" id="adminStatus" href="javascript:void(0)"
//                                               data-id="'.$admin->id.'" data-status="'.$admin->status.'"> <i
//                                                        class="fa-solid fa-toggle-off fa-2x" style="color: grey"></i>
//                                            </a>';
//                }
//            })

            ->addColumn('permissions', function ($role) {
                $perp_names = $role->permissions->pluck('name');
                $badge='';
                foreach ($perp_names as $perm) {
                    $badge  .=  '<span class="badge bg-success p-1 mx-1 my-1">'.$perm.'</span>';

                }
                return $badge;
            })
            ->addColumn('action', function ($role) {
                $addPermission = route('admin.role.assign-permissions-page', $role->id);
              

                return '<div class="d-flex gap-3">  
                            <a class="btn btn-sm btn-primary" href="'.$addPermission.'"><i class="fa-solid fa-user-plus"></i></a> 
                            <a class="editButton btn btn-sm btn-primary" href="javascript:void(0)" data-id="'.$role->id.'" data-bs-toggle="modal" data-bs-target="#editRoleModal"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-sm btn-danger" href="javascript:void(0)" data-id="'.$role->id.'" id="deleteRoleBtn""> <i class="fas fa-trash"></i></a>
                        </div>';
            })
            ->rawColumns(['action', 'permissions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = "web";
        $save= $role->save();
        
        if (!$save) {
            return response()->json(['status' => 'failed', 'message' => 'Something went wrong'], 500);
        }
        return response()->json(['status' => 'success', 'message' => 'Role created successfully'], 201);
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
        $role = Role::findOrFail($id);

        if ($role) {
            return response()->json(['status' => 'success','message'=>'Role fetched successfully', 'data' => $role], 200);
        }

        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);

        if ($role) {
            $role->name = $request->name;


            $role->save();

            return response()->json(['status' => 'success','message'=>'Role updated successfully'], 200);

        }
        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        if ($role) {
            $role->delete();

            return response()->json(['status' => 'success','message'=>'Role updated successfully'], 200);
        }
        
        return response()->json(['status' => 'failed','message' => 'Something went wrong'], 500);
    }

//    public function changeRoleStatus(Request $request)
//    {
//        $id = $request->id;
//        $status = $request->status;
//
//
//        if ($status == 1) {
//            $stat = 0;
//        } else {
//            $stat = 1;
//        }
//
//        $page = Admin::findOrFail($id);
//        $page->status = $stat;
//        $page->save();
//
//        return response()->json(['message' => 'success', 'status' => $stat, 'id' => $id]);
//    }

    public function create()
    {
    }

    public function assignPermissionsToRolePage(string $id)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($id);

        return view('backend.pages.role.assign-permission', compact('permissions', 'role'));
    }

    public function assignPermissionsToRole(Request $request, string $id)
    {
//        dd(\request()->all());


        $role = Role::findOrFail($id);


        $assignePerm = $role->syncPermissions(\request()->permissions);


        if ($assignePerm) {
            return redirect()->back()->with('success', 'Permission Updated !');
        }
        return redirect()->back()->with('error', 'Error Occured !');
    }
}
