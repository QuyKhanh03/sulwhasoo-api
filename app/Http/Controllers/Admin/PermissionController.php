<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{
    //get all permissions
    public function getPermissions(Request $request)
    {
        try {
            $data = Permission::all();
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
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = 'Permissions';
            return view('pages.permissions.index', compact('title'));
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Permission::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Permission created successfully'
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
        try {
            $permission = Permission::find($id);
            return response()->json([
                'success' => true,
                'data' => $permission
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Permission::find($id)->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Permission updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Permission::find($id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully'
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
