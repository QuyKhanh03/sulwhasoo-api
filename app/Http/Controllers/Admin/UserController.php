<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $model = auth()->user();
            $model->fill($request->except(['avatar','password']));
            if($request->hasFile('avatar')){
                $model->avatar = uploadImage($request->file('avatar'));
            }

            if($request->filled('password')){
                $model->password = bcrypt($request->password);
            }

            $model->save();
            Toastr::success('Account updated successfully');
            return response()->json(['success'=>true,'message'=>'Account updated successfully']);
        }
        $title = 'Account';
        return view('pages.account.index',compact('title'));
    }


}
