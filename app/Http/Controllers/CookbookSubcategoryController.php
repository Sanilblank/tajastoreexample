<?php

namespace App\Http\Controllers;

use App\Models\CookbookSubcategory;
use App\Http\Controllers\Controller;
use App\Models\CookbookCategory;
use App\Models\CookbookItem;
use App\Models\CookbookNavbar;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CookbookSubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //
        $navbaritem = CookbookNavbar::findorfail($id);
        if($request->user()->can('manage-cookbook')){
            if ($request->ajax()) {
                $data = CookbookSubcategory::latest()->where('cookbooknavbar_id', $id)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function ($row) {
                        return $row->category->category;
                    })
                    ->addColumn('image', function ($row) {
                        $imageurl = Storage::disk('uploads')->url($row->image);

                        $image = "<img src='$imageurl'style = 'max-height:100px'>";
                        return $image;
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
                        $editurl = route('cookbooksubcategory.edit', $row->id);
                        $deleteurl = route('cookbooksubcategory.destroy', $row->id);
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
                    ->rawColumns(['category', 'image','status', 'action'])
                    ->make(true);
            }

            return view('backend.cookbooksubcategory.index', compact('navbaritem'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $navbaritem = CookbookNavbar::findorfail($id);
            $categories = CookbookCategory::latest()->where('cookbooknavbar_id', $id)->where('status', 1)->get();
            return view('backend.cookbooksubcategory.create', compact('navbaritem', 'categories'));

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
        if($request->user()->can('manage-cookbook')){
            $data = $this->validate($request, [
                'cookbooknavbar_id'=>'required',
                'cookbookcategory_id'=>'required',
                'subcategory'=>'required',
                'image'=>'required|mimes:png,jpg,jpeg',
                'status'=>'required',
            ]);

            $imagename = '';
            if($request->hasfile('image')){
                $image = $request->file('image');
                $imagename = $image->store('cookbooksubcategory_image', 'uploads');

            }

            $subcategory = CookbookSubcategory::create([
                'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
                'cookbookcategory_id'=>$data['cookbookcategory_id'],
                'subcategory'=>$data['subcategory'],
                'slug'=>Str::slug($data['subcategory']),
                'image'=>$imagename,
                'status'=>$data['status'],

            ]);

            $subcategory->save();

            return redirect()->route('cookbooksubcategory.index', $data['cookbooknavbar_id'])->with('success', 'Added Successfully.');

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CookbookSubcategory  $cookbookSubcategory
     * @return \Illuminate\Http\Response
     */
    public function show(CookbookSubcategory $cookbookSubcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CookbookSubcategory  $cookbookSubcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $subcategory = CookbookSubcategory::findorfail($id);
            $categories = CookbookCategory::latest()->where('cookbooknavbar_id', $subcategory->cookbooknavbar_id)->where('status', 1)->get();
            return view('backend.cookbooksubcategory.edit', compact('subcategory', 'categories'));

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CookbookSubcategory  $cookbookSubcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $subcategory = CookbookSubcategory::findorfail($id);
        $data = $this->validate($request, [
            'cookbooknavbar_id'=>'required',
            'cookbookcategory_id'=>'required',
            'subcategory'=>'required',
            'image'=>'mimes:png,jpg, jpeg',
            'status'=>'required',
        ]);

        if($data['cookbookcategory_id'] != $subcategory->cookbookcategory_id)
        {
            $items = CookbookItem::where('cookbooksubcategory_id', $subcategory->id)->get();
            if(count($items) > 0)
            {
                foreach($items as $item)
                {
                    $item->update([
                        'cookbookcategory_id'=>$data['cookbookcategory_id'],
                    ]);
                }
            }
        }

        $imagename = '';
        if($request->hasfile('image')){
            $image = $request->file('image');
            Storage::disk('uploads')->delete($subcategory->image);
            $imagename = $image->store('cookbooksubcategory_image', 'uploads');
        } else{
            $imagename = $subcategory->image;
        }

        $subcategory->update([
                'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
                'cookbookcategory_id'=>$data['cookbookcategory_id'],
                'subcategory'=>$data['subcategory'],
                'slug'=>Str::slug($data['subcategory']),
                'image'=>$imagename,
                'status'=>$data['status'],
        ]);
        return redirect()->route('cookbooksubcategory.index', $data['cookbooknavbar_id'])->with('success', 'Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CookbookSubcategory  $cookbookSubcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $subcategory = CookbookSubcategory::findorfail($id);
            $items = CookbookItem::where('cookbooksubcategory_id', $id)->get();
            if(count($items) > 0)
            {
                return redirect()->back()->with('failure', 'Subcategory is being used by item.');
            }

            Storage::disk('uploads')->delete($subcategory->image);
            $subcategory->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');

        }else{
            return view('backend.permission.permission');
        }
    }
}
