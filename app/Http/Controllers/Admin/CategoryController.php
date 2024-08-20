<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{

    public function getCategories(Request $request)
    {
        if($request->ajax()) {
            $data = Category::all();
            return DataTables::of($data)->addIndexColumn()
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

                //parent
                ->addColumn('parent', function ($row) {
                    return $row->parent ? $row->parent->name : 'N/A';
                })
                ->rawColumns(['actions', 'created_at', 'updated_at', 'parent'])
                ->make(true);
        }
    }

    public function getAllCategories()
    {
        $categories = Category::all();
        return response()->json(
            [
                'success' => true,
                'categories' => $categories
            ]
        );
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Categories';
        return view('pages.categories.index', compact('title'));
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
            'name' => 'required|string|max:255',
        ]);

        $model = new Category();
        $model->fill($request->except(['slug']));
        $model->slug = createSlug($request->name);
        if($request->has('parent_id')) {
            $model->parent_id = $request->parent_id;
        }
        $model->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Category created successfully'
            ]
        );

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
        $category = Category::find($id);
        return response()->json(
            [
                'success' => true,
                'category' => $category
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $model = Category::find($id);
        $model->fill($request->except(['slug']));
        $model->slug = createSlug($request->name);
        if($request->has('parent_id')) {
            $model->parent_id = $request->parent_id;
        }
        $model->save();
        return response()->json(
            [
                'success' => true,
                'message' => 'Category updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Category::find($id);
        $model->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Category deleted successfully'
            ]
        );
    }
}
