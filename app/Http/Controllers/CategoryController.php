<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->user()->can('manage-category')) {
            if ($request->ajax()) {
                $data = Category::latest()->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('status', function($row){
                            if($row->status == 1){
                                $status = 'Approved';
                            }else{
                                $status = 'Not Approved';
                            }
                            return $status;
                        })
                        ->editColumn('featured', function($row){
                            if($row->featured == 1){
                                $featured = 'Yes';
                            }else{
                                $featured = 'No';
                            }
                            return $featured;
                        })
                        ->addColumn('action', function($row){
                                $editurl = route('category.edit', $row->id);
                                $deleteurl = route('category.destroy', $row->id);
                                $csrf_token = csrf_token();
                            $btn = "<a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                            <form action='$deleteurl' method='POST' style='display:inline;'>
                            <input type='hidden' name='_token' value='$csrf_token'>
                            <input type='hidden' name='_method' value='DELETE' />
                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                            ";

                                return $btn;
                        })
                        ->rawColumns(['status', 'featured', 'action'])
                        ->make(true);
            }
            return view('backend.category.index');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->user()->can('manage-category')){
            return view('backend.category.create');
        }
        else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->user()->can('manage-category')){
            $data = $this->validate($request,[
                'title'=>'required',
                'status'=>'required',
                'featured'=>'required',
            ]);

            $category = Category::create([
                'title'=> $data['title'],
                'slug'=>Str::slug($data['title']),
                'status'=>$data['status'],
                'featured'=>$data['featured'],
            ]);
            $category->save();
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        if($request->user()->can('manage-category')){
            $category = Category::findorfail($id);
            return view('backend.category.edit', compact('category'));
        }
        else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('manage-category')){
            $category = Category::findorfail($id);
            $data = $this->validate($request,[
                'title'=>'required',
                'status'=>'required',
                'featured'=>'required',
            ]);

            $category->update([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'status' => $data['status'],
                'featured' => $data['featured'],
            ]);
            $category->save();
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        }
        else{
            return view('backend.permission.permission');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        if($request->user()->can('manage-category')){
            $category = Category::findorfail($id);
            $subcategory = Subcategory::where('category_id', $category->id)->get();
            if(count($subcategory) == 0) {
                $category->delete();
                return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
            } else {
                return redirect()->route('category.index')->with('failure', 'Category has sub categories. Cannot delete.');
            }
        }
        else{
            return view('backend.permission.permission');
        }
    }
}
