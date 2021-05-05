<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class VendorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $status = 'Approved';
                    } else {
                        $status = 'Not Approved';
                    }
                    return $status;
                })
                ->editColumn('featured', function ($row) {
                    if ($row->featured == 1) {
                        $featured = 'Yes';
                    } else {
                        $featured = 'No';
                    }
                    return $featured;
                })
                ->addColumn('action', function ($row) {
                    $editurl = route('singlevendorcategory.edit', $row->id);
                    $deleteurl = route('singlevendorcategory.destroy', $row->id);
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
        return view('backend.singlevendor.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.singlevendor.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
            'featured' => 'required',
        ]);

        $category = Category::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'status' => $data['status'],
            'featured' => $data['featured'],
        ]);
        $category->save();

        return redirect()->route('singlevendorcategory.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findorfail($id);
        return view('backend.singlevendor.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findorfail($id);
        $data = $this->validate($request, [
            'title' => 'required',
            'status' => 'required',
            'featured' => 'required',
        ]);

        $category->update([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'status' => $data['status'],
            'featured' => $data['featured'],
        ]);
        $category->save();
        return redirect()->route('singlevendorcategory.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        $subcategory = Subcategory::where('category_id', $category->id)->get();
        if (count($subcategory) == 0) {
            $category->delete();
            return redirect()->route('singlevendorcategory.index')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('singlevendorcategory.index')->with('failure', 'Category has sub categories. Cannot delete.');
        }
    }
}
