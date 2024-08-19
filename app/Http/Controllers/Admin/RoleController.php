<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    public function getRole(Request $request)
    {
        $data = Role::all();
        return DataTables::of($data)->addIndexColumn()
            ->addColumn('actions', function($row) {
                $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'"  class=" btn btn-sm btn-danger btn-delete">Remove</a>';
                $btn .= '  <a href="javascript:void(0)" data-id="'.$row->id.'" class="edit btn-sm btn btn-success btn-edit">Edit</a>';
                return $btn;
            })
            ->addColumn('created_at', function($row) {
                return date('d-m-Y', strtotime($row->created_at));
            })
            ->addColumn('updated_at', function($row) {
                return date('d-m-Y', strtotime($row->updated_at));
            })
            ->rawColumns(['actions', 'created_at', 'updated_at'])
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Roles';
        $permissions = Permission::all();
        return view('pages.roles.index', compact('title', 'permissions'));
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

        $request->validate([
            'name' => 'required',
        ]);
        $role = Role::create(['name' => $request->name]);
        $permissions = [];
        foreach ($request->permissions as $permission) {
            $permissions[] = Permission::findById($permission);

        }
        $role->syncPermissions($permissions);
        return response()->json([
            'success' => true,
            'message' => 'Role created successfully'
        ]);
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
        $role = Role::findById($id);
        $permissions = [];
        foreach ($role->permissions as $permission) {
            $permissions[] = $permission->id;
        }
        $role->permissions = $permissions;
        return response()->json(['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::findById($id);
        $role->name = $request->name;
        $role->save();

        $permissions = [];
        foreach ($request->permissions as $permission) {
            $permissions[] = Permission::findById($permission);
        }
        $role->syncPermissions($permissions);

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id);

        // Revoke all permissions associated with this role
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission);
        }

        // Delete the role
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully'
        ]);
    }
}
