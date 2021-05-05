<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
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
                $data = Subcategory::latest()->with('category')->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->editColumn('category_id', function($row){
                            $category = $row->category->title;
                            return $category;
                        })
                        ->editColumn('image', function($row){
                            $imageurl = Storage::disk('uploads')->url($row->image_name);
                            $image = "<img src='$imageurl' style = 'max-height:100px'>";
                            return $image;
                        })
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
                                $editurl = route('subcategory.edit', $row->id);
                                $deleteurl = route('subcategory.destroy', $row->id);
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
                        ->rawColumns(['category_id','status', 'featured', 'action', 'image'])
                        ->make(true);
            }
            return view('backend.subcategory.index');
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
        if($request->user()->can('manage-subcategory')){
            $categories = Category::all();
            return view('backend.subcategory.create', compact('categories'));
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
        if($request->user()->can('manage-subcategory')){
            $data = $this->validate($request,[
                'category_id'=>'required',
                'title'=>'required',
                'status'=>'required',
                'featured'=>'required',
                'subcategory_image'=>'required|mimes:jpg,png,jpeg',
            ]);
            $imagename = '';
            if($request->hasfile('subcategory_image')){
                $image = $request->file('subcategory_image');
                $imagename = $image->store('subcategory_images', 'uploads');
                $subcategory = Subcategory::create([
                    'category_id'=>$data['category_id'],
                    'title'=> $data['title'],
                    'slug'=>Str::slug($data['title']),
                    'status'=>$data['status'],
                    'featured'=>$data['featured'],
                    'image_name' => $imagename
                ]);
                $subcategory->save();
            }

            return redirect()->route('subcategory.index')->with('success', 'Subcategory created successfully.');
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        //
        if($request->user()->can('manage-category')){
            $categories = Category::all();
            $subcategory = Subcategory::findorfail($id);
            return view('backend.subcategory.edit', compact('categories', 'subcategory'));
        }
        else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if($request->user()->can('manage-subcategory')){
            $subcategory = Subcategory::findorfail($id);
            $data = $this->validate($request,[
                'category_id'=>'required',
                'title'=>'required',
                'status'=>'required',
                'featured'=>'required',
                'subcategory_image' => 'mimes:jpg,png,jpeg'
            ]);
            $imagename = '';
            if($request->hasfile('subcategory_image')){
                $image = $request->file('subcategory_image');
                Storage::disk('uploads')->delete($subcategory->image_name);
                $imagename = $image->store('subcategory_images', 'uploads');
            } else{
                $imagename = $subcategory->image_name;
            }

            $subcategory->update([
                'category_id'=>$data['category_id'],
                'title'=> $data['title'],
                'slug'=>Str::slug($data['title']),
                'status'=>$data['status'],
                'featured'=>$data['featured'],
                'image_name' => $imagename
            ]);
            $subcategory->save();
            return redirect()->route('subcategory.index')->with('success', 'Subcategory updated successfully.');
        }
        else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        if($request->user()->can('manage-subcategory')){
            $subcategory = Subcategory::findorfail($id);
            $products = Product::where('subcategory_id', $subcategory->id)->get();
            if(count($products) == 0) {
                Storage::disk('uploads')->delete($subcategory->image_name);
                $subcategory->delete();
                return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully.');
            } else {
                return redirect()->route('subcategory.index')->with('failure', 'Subcategory has products. Cannot delete.');
            }
        }
        else{
            return view('backend.permission.permission');
        }
    }
}
