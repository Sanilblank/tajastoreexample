<?php

namespace App\Http\Controllers;

use App\Models\CookbookNavbar;
use App\Http\Controllers\Controller;
use App\Models\CookbookCategory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class CookbookNavbarController extends Controller
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
                $data = CookbookNavbar::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('icon', function ($row) {
                        $imageurl = Storage::disk('uploads')->url($row->icon);

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
                        $editurl = route('cookbooknavbar.edit', $row->id);
                        $deleteurl = route('cookbooknavbar.destroy', $row->id);
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
                    ->rawColumns(['icon', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.cookbooknavbar.index');

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
            return view('backend.cookbooknavbar.create');

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
            'navbar_item'=>'required',
            'icon'=>'required|mimes:png,jpg,jpeg',
            'status'=>'required',
        ]);

            $imagename = '';
            if($request->hasfile('icon')){
                $image = $request->file('icon');
                $imagename = $image->store('navbaricon_image', 'uploads');
                $navbaritem = CookbookNavbar::create([
                    'navbar_item'=>$data['navbar_item'],
                    'icon'=>$imagename,
                    'status'=>$data['status'],
                ]);
                $navbaritem->save();
            }

            return redirect()->route('cookbooknavbar.index')->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CookbookNavbar  $cookbookNavbar
     * @return \Illuminate\Http\Response
     */
    public function show(CookbookNavbar $cookbookNavbar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CookbookNavbar  $cookbookNavbar
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $navbaritem = CookbookNavbar::findorfail($id);
            return view('backend.cookbooknavbar.edit', compact('navbaritem'));

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CookbookNavbar  $cookbookNavbar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $navbaritem = CookbookNavbar::findorfail($id);
        $data = $this->validate($request, [
            'navbar_item'=>'required',
            'icon'=>'mimes:png,jpg,jpeg',
            'status'=>'required',
        ]);

        $imagename = '';
        if($request->hasfile('icon')){
            $image = $request->file('icon');
            Storage::disk('uploads')->delete($navbaritem->icon);
            $imagename = $image->store('navbaricon_image', 'uploads');
        } else{
            $imagename = $navbaritem->icon;
        }

        $navbaritem->update([
            'navbar_item'=>$data['navbar_item'],
            'icon'=>$imagename,
            'status'=>$data['status'],
        ]);
        return redirect()->route('cookbooknavbar.index')->with('success', 'Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CookbookNavbar  $cookbookNavbar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Before Deleting must chekck if navitem is in use in other tables to be created later
        if($request->user()->can('manage-cookbook')){
            $navbaritem = CookbookNavbar::findorfail($id);
            $categories = CookbookCategory::where('cookbooknavbar_id', $id)->get();
           if(count($categories) > 0)
           {
                return redirect()->route('cookbooknavbar.index')->with('failure', 'Item is in use in Category');
           }

            Storage::disk('uploads')->delete($navbaritem->icon);
            $navbaritem->delete();
        }else{
            return view('backend.permission.permission');
        }
        return redirect()->route('cookbooknavbar.index')->with('success', 'Deleted Successfully');
    }
}
