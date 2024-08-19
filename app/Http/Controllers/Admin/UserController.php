<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get(); // Eager load roles relationship
            return DataTables::of($data)->addIndexColumn()

                // Avatar
                ->addColumn('avatar', function ($row) {
                    $avatarSrc = ($row->avatar != null) ? $row->avatar : asset('theme/assets/media/svg/avatars/blank.svg');
                    return '<img src="' . $avatarSrc . '" width="50" height="50" class="img-circle" />';
                })

                // Roles
                ->addColumn('roles', function ($row) {
                    if($row->roles->isEmpty()) {
                        return '<span class="badge badge-danger">No Role</span>';
                    }
                    return $row->roles->map(function ($role) {
                        return '<span class="badge badge-primary">' . $role->name . '</span>';
                    })->implode(' ');
                })

                // Actions
                ->addColumn('actions', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-danger btn-delete">Remove</a>';
                    $btn .= '  <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn-sm btn btn-success btn-edit">Edit</a>';
                    return $btn;
                })

                // Created At
                ->addColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })

                // Updated At
                ->addColumn('updated_at', function ($row) {
                    return date('d-m-Y', strtotime($row->updated_at));
                })
                ->rawColumns(['avatar', 'roles', 'actions', 'created_at', 'updated_at'])
                ->make(true);
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = 'Users';
            return view('pages.users.index', compact('title'));
        } catch (\Exception $e) {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $model = new User();

        $model->fill($request->except(['avatar', 'password']));
        if ($request->hasFile('avatar')) {
            $model->avatar = uploadImage($request->file('avatar'));
        }
        $model->password = bcrypt($request->password);

        if($request->has('roles')) {
            $roles = [];
            foreach($request->roles as $role) {
                $roles[] = $role['name'];
            }
            $model->assignRole($roles);
        }

        $model->save();

        return response()->json(['success' => true, 'message' => 'User created successfully']);
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
        $model = User::with('roles')->find($id);
        return response()->json(['success' => true, 'data' => $model]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $model = User::find($id);

        $model->fill($request->except(['avatar', 'password']));
        if ($request->hasFile('avatar')) {
            $model->avatar = uploadImage($request->file('avatar'));
        }

        if($request->has('roles')) {
            $roles = [];
            foreach($request->roles as $role) {
                $roles[] = $role['name'];
            }
            $model->syncRoles($roles);
        }

        $model->save();

        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::find($id);
        $model->delete();

        // check if user has roles and remove them
        if($model->roles->isNotEmpty()) {
            $model->removeRole($model->roles->pluck('name')->toArray());
        }

        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    }


    //account
    public function account(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $model = auth()->user();
            $model->fill($request->except(['avatar', 'password']));
            if ($request->hasFile('avatar')) {
                $model->avatar = uploadImage($request->file('avatar'));
            }

            if ($request->filled('password')) {
                $model->password = bcrypt($request->password);
            }

            $model->save();
            Toastr::success('Account updated successfully');
            return response()->json(['success' => true, 'message' => 'Account updated successfully']);
        }
        $title = 'Account';
        return view('pages.account.index', compact('title'));
    }




}
