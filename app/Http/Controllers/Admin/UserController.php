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
            $data = User::all();
            return DataTables::of($data)->addIndexColumn()

//                //avatar
//                ->addColumn('avatar', function ($row) {
//                    if (empty($row->avatar)) {
//                        $avatarSrc = asset('theme/assets/media/svg/avatars/blank.svg');
//                    } else {
//                        $avatarSrc = asset($row->avatar);
//                    }
//                    $avatar = '<img src="' . $avatarSrc . '" width="50" height="50" class="img-circle" />';
//                    return $avatar;
//                })
//
//                //roles
//                ->addColumn('roles', function ($row) {
//                    $roles = '';
//                    foreach ($row->roles as $role) {
//                        $roles .= '<span class="badge badge-primary">' . $role->name . '</span>';
//                    }
//                    return $roles;
//                })
                ->addColumn('actions', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '"  class=" btn btn-danger btn-delete">Remove</a>';
                    $btn .= '  <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-success btn-edit">Edit</a>';
                    return $btn;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-m-Y', strtotime($row->created_at));
                })
                ->addColumn('updated_at', function ($row) {
                    return date('d-m-Y', strtotime($row->updated_at));
                })
                ->rawColumns(['actions', 'created_at', 'updated_at'])
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
