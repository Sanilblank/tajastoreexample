<?php

namespace App\Http\Controllers;

use App\Models\CookbookCategory;
use App\Http\Controllers\Controller;
use App\Models\CookbookItem;
use App\Models\CookbookNavbar;
use App\Models\CookbookSubcategory;
use Illuminate\Http\Request;
use DataTables;

class CookbookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-cookbook')){
            if ($request->ajax()) {
                $data = CookbookCategory::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('navbar_item', function ($row) {
                        return $row->navbar->navbar_item;
                    })
                    ->addColumn('status', function ($row) {
                        if($row->status == 1)
                        {
                            $status = '<span class="badge bg-green" style="background-color: green";>Active</span>';
                        }
                        else
                        {
                            $status = '<span class="badge bg-danger" style="color: white";>Inactive</span>';
                        }
                        return $status;
                    })
                    ->addColumn('action', function($row){
                        $editurl = route('cookbookcategory.edit', $row->id);
                        $deleteurl = route('cookbookcategory.destroy', $row->id);
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
                    ->rawColumns(['navbar_item', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.cookbookcategory.index');

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
        if($request->user()->can('manage-cookbook')){
            $navbaritems = CookbookNavbar::latest()->where('status', 1)->get();
            return view('backend.cookbookcategory.create', compact('navbaritems'));

        }else{
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
        $data = $this->validate($request, [
            'cookbooknavbar_id'=>'required',
            'category'=>'required',
            'status'=>'required',
        ]);


                $cookbookCategory = CookbookCategory::create([
                    'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
                    'category'=>$data['category'],
                    'status'=>$data['status'],
                ]);
                $cookbookCategory->save();


            return redirect()->route('cookbookcategory.index')->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CookbookCategory  $cookbookCategory
     * @return \Illuminate\Http\Response
     */
    public function show(CookbookCategory $cookbookCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CookbookCategory  $cookbookCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $category = CookbookCategory::findorfail($id);
            $navbaritems = CookbookNavbar::latest()->where('status', 1)->get();
            return view('backend.cookbookcategory.edit', compact('category', 'navbaritems'));

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CookbookCategory  $cookbookCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = CookbookCategory::findorfail($id);
        $data = $this->validate($request, [
            'cookbooknavbar_id'=>'required',
            'category'=>'required',
            'status'=>'required',
        ]);

        if($data['cookbooknavbar_id'] != $category->cookbooknavbar_id)
        {
            $subcategories = CookbookSubcategory::where('cookbookcategory_id', $category->id)->get();
            if(count($subcategories) > 0)
            {
                foreach($subcategories as $subcategory)
                {
                    $subcategory->update([
                        'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
                    ]);
                }
            }

            $subcategories2 = CookbookItem::where('cookbookcategory_id', $category->id)->get();
            if(count($subcategories2) > 0)
            {
                foreach($subcategories2 as $subcategory2)
                {
                    $subcategory2->update([
                        'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
                    ]);
                }
            }
        }

        $category->update([
            'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
            'category'=>$data['category'],
            'status'=>$data['status'],
        ]);


        return redirect()->route('cookbookcategory.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CookbookCategory  $cookbookCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $category = CookbookCategory::findorfail($id);
            $subcategory = CookbookSubcategory::where('cookbookcategory_id', $id)->get();
            if(count($subcategory) > 0)
            {
                return redirect()->back()->with('failure', 'Subcategory exists for this category');
            }
            $category->delete();
        }else{
            return view('backend.permission.permission');
        }
        return redirect()->route('cookbookcategory.index')->with('success', 'Deleted Successfully');

    }
}
