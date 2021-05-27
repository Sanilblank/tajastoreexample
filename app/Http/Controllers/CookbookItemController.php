<?php

namespace App\Http\Controllers;

use App\Models\CookbookItem;
use App\Http\Controllers\Controller;
use App\Models\CookbookCategory;
use App\Models\CookbookNavbar;
use App\Models\CookbookSubcategory;
use App\Models\Ingredient;
use App\Models\Levelofcooking;
use App\Models\Recipetype;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CookbookItemController extends Controller
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
                $data = CookbookItem::latest()->where('cookbooknavbar_id', $id)->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category', function ($row) {
                        return $row->category->category;
                    })
                    ->addColumn('subcategory', function ($row) {
                        return $row->subcategory->subcategory;
                    })
                    ->addColumn('itemimage', function ($row) {
                        $imageurl = Storage::disk('uploads')->url($row->itemimage);

                        $image = "<img src='$imageurl'style = 'max-height:100px'>";
                        return $image;
                    })
                    // ->addColumn('recipebyimage', function ($row) {
                    //     $imageurl = Storage::disk('uploads')->url($row->recipebyimage);

                    //     $image = "<img src='$imageurl'style = 'max-height:100px'>";
                    //     return $image;
                    // })
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
                        $editurl = route('cookbookitem.edit', $row->id);
                        $deleteurl = route('cookbookitem.destroy', $row->id);
                        $showurl = route('cookbookitem.show', $row->id);
                        $csrf_token = csrf_token();
                        $btn = "<a href='$showurl' class='edit btn btn-warning btn-sm'>Show</a>
                                <a href='$editurl' class='edit btn btn-primary btn-sm'>Edit</a>
                               <form action='$deleteurl' method='POST' style='display:inline;'>
                                <input type='hidden' name='_token' value='$csrf_token'>
                                <input type='hidden' name='_method' value='DELETE' />
                                   <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                               </form>
                               ";

                                return $btn;
                    })
                    ->rawColumns(['category', 'subcategory', 'itemimage', 'status', 'action'])
                    ->make(true);
            }

            return view('backend.cookbookitem.index', compact('navbaritem'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function storeingredient(Request $request)
    {
        $data = $this->validate($request, [
            'product_id'=>'required',
            'item'=>'required',
        ]);

        $existing = Ingredient::where('cookbookitem_id', 0)->where('product_id', $data['product_id'])->first();
        if($existing)
        {
            return redirect()->back()->with('failure', 'Ingredient Exists.');

        }

        $ingredient = Ingredient::create([
            'cookbookitem_id'=>0,
            'product_id'=>$data['product_id'],
            'item'=>$data['item'],
        ]);
        $ingredient->save();

        return redirect()->back()->with('success', 'Ingredient Added.');
    }

    public function updateingredient(Request $request, $id)
    {
        $data = $this->validate($request, [
            'product_id'=>'required',
            'item'=>'required',
        ]);

        $existing = Ingredient::where('cookbookitem_id', $id)->where('product_id', $data['product_id'])->first();
        if($existing)
        {
            return redirect()->back()->with('failure', 'Ingredient Exists.');

        }

        $ingredient = Ingredient::create([
            'cookbookitem_id'=>$id,
            'product_id'=>$data['product_id'],
            'item'=>$data['item'],
        ]);
        $ingredient->save();

        return redirect()->back()->with('success', 'Ingredient Added.');
    }

    public function removeingredient($id)
    {
        $ingredient = Ingredient::findorfail($id);
        $ingredient->delete();

        return redirect()->back()->with('success', 'Ingredient Deleted.');

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
            $subcategories = CookbookSubcategory::latest()->where('cookbooknavbar_id', $id)->where('status', 1)->get();
            $levels = Levelofcooking::all();
            $recipetypes = Recipetype::all();

            $ingredients = Ingredient::where('cookbookitem_id', 0)->with('product')->get();
            return view('backend.cookbookitem.create', compact('navbaritem', 'categories', 'subcategories', 'levels', 'recipetypes', 'ingredients'));

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
            'cookbookcategory_id'=>'required',
            'cookbooksubcategory_id'=>'required',
            'itemname'=>'required',
            'itemimage'=>'required|mimes:png,jpg,jpeg',
            'recipeby'=>'required',
            'recipebyimage'=>'required|mimes:png,jpg,jpeg',
            'serving'=>'required',
            'timetoprepare'=>'required',
            'timetocook'=>'required',
            'description'=>'required',
            'course'=>'required',
            'cuisine'=>'required',
            'timeofday'=>'required',
            'levelofcooking_id'=>'required',
            'recipetype_id'=>'required',
            'steps'=>'required',
            'status'=>'required',
        ]);

        $subcategory = CookbookSubcategory::findorfail($data['cookbooksubcategory_id']);
        if($subcategory->cookbookcategory_id != $data['cookbookcategory_id'])
        {
            return redirect()->back()->with('failure', 'No such subcategory in selected category.');
        }

            $imagename = '';
            if($request->hasfile('itemimage')){
                $image = $request->file('itemimage');
                $imagename = $image->store('cookbookitem_image', 'uploads');
            }

            $authorimage = '';
            if($request->hasfile('recipebyimage')){
                $image = $request->file('recipebyimage');
                $authorimage = $image->store('cookbookrecipeby_image', 'uploads');
            }

            $item = CookbookItem::create([
                'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
                'cookbookcategory_id'=>$data['cookbookcategory_id'],
                'cookbooksubcategory_id'=>$data['cookbooksubcategory_id'],
                'itemname'=>$data['itemname'],
                'slug'=>Str::slug($data['itemname']),
                'itemimage'=>$imagename,
                'recipeby'=>$data['recipeby'],
                'recipebyimage'=>$authorimage,
                'serving'=>$data['serving'],
                'timetoprepare'=>$data['timetoprepare'],
                'timetocook'=>$data['timetocook'],
                'description'=>$data['description'],
                'course'=>$data['course'],
                'cuisine'=>$data['cuisine'],
                'timeofday'=>$data['timeofday'],
                'levelofcooking_id'=>$data['levelofcooking_id'],
                'recipetype_id'=>$data['recipetype_id'],
                'steps'=>$data['steps'],
                'status'=>$data['status'],
            ]);
            $item->save();

            $ingredients = Ingredient::where('cookbookitem_id', 0)->get();
            foreach($ingredients as $ingredient)
            {
                $ingredient->update([
                    'cookbookitem_id'=>$item->id,
                ]);
            }

            return redirect()->route('cookbookitem.index', $data['cookbooknavbar_id'])->with('success', 'Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CookbookItem  $cookbookItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $cookbookitem = CookbookItem::findorfail($id);
            $ingredients = Ingredient::where('cookbookitem_id', $cookbookitem->id)->get();

            return view('backend.cookbookitem.show', compact('cookbookitem', 'ingredients'));
        }else{
            return view('backend.permission.permission');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CookbookItem  $cookbookItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $cookbookitem = CookbookItem::findorfail($id);
            $categories = CookbookCategory::latest()->where('cookbooknavbar_id', $cookbookitem->cookbooknavbar_id)->where('status', 1)->get();
            $subcategories = CookbookSubcategory::latest()->where('cookbooknavbar_id', $cookbookitem->cookbooknavbar_id)->where('status', 1)->get();
            $levels = Levelofcooking::all();
            $recipetypes = Recipetype::all();

            $ingredients = Ingredient::where('cookbookitem_id', $id)->get();

            return view('backend.cookbookitem.edit', compact('cookbookitem', 'categories', 'subcategories', 'levels', 'recipetypes', 'ingredients'));

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CookbookItem  $cookbookItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $cookbookitem = CookbookItem::findorfail($id);
        $data = $this->validate($request, [
            'cookbooknavbar_id'=>'required',
            'cookbookcategory_id'=>'required',
            'cookbooksubcategory_id'=>'required',
            'itemname'=>'required',
            'itemimage'=>'mimes:png,jpg,jpeg',
            'recipeby'=>'required',
            'recipebyimage'=>'mimes:png,jpg,jpeg',
            'serving'=>'required',
            'timetoprepare'=>'required',
            'timetocook'=>'required',
            'description'=>'required',
            'course'=>'required',
            'cuisine'=>'required',
            'timeofday'=>'required',
            'levelofcooking_id'=>'required',
            'recipetype_id'=>'required',
            'steps'=>'required',
            'status'=>'required',
        ]);

        $subcategory = CookbookSubcategory::findorfail($data['cookbooksubcategory_id']);
        if($subcategory->cookbookcategory_id != $data['cookbookcategory_id'])
        {
            return redirect()->back()->with('failure', 'No such subcategory in selected category.');
        }

        $imagename = '';
        if($request->hasfile('itemimage')){
            $image = $request->file('itemimage');
            Storage::disk('uploads')->delete($cookbookitem->itemimage);
            $imagename = $image->store('cookbookitem_image', 'uploads');
        } else{
            $imagename = $cookbookitem->itemimage;
        }

        $authorimage = '';
        if($request->hasfile('recipebyimage')){
            $image = $request->file('recipebyimage');
            Storage::disk('uploads')->delete($cookbookitem->recipebyimage);
            $authorimage = $image->store('cookbookrecipeby_image', 'uploads');
        } else{
            $authorimage = $cookbookitem->recipebyimage;
        }

        $cookbookitem->update([
            'cookbooknavbar_id'=>$data['cookbooknavbar_id'],
            'cookbookcategory_id'=>$data['cookbookcategory_id'],
            'cookbooksubcategory_id'=>$data['cookbooksubcategory_id'],
            'itemname'=>$data['itemname'],
            'slug'=>Str::slug($data['itemname']),
            'itemimage'=>$imagename,
            'recipeby'=>$data['recipeby'],
            'recipebyimage'=>$authorimage,
            'serving'=>$data['serving'],
            'timetoprepare'=>$data['timetoprepare'],
            'timetocook'=>$data['timetocook'],
            'description'=>$data['description'],
            'course'=>$data['course'],
            'cuisine'=>$data['cuisine'],
            'timeofday'=>$data['timeofday'],
            'levelofcooking_id'=>$data['levelofcooking_id'],
            'recipetype_id'=>$data['recipetype_id'],
            'steps'=>$data['steps'],
            'status'=>$data['status'],
        ]);
        return redirect()->route('cookbookitem.index', $data['cookbooknavbar_id'])->with('success', 'Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CookbookItem  $cookbookItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-cookbook')){
            $cookbookitem = CookbookItem::findorfail($id);
            Storage::disk('uploads')->delete($cookbookitem->itemimage);
            Storage::disk('uploads')->delete($cookbookitem->recipebyimage);

            $ingredients = Ingredient::where('cookbookitem_id', $cookbookitem->id)->get();
            if(count($ingredients) > 0)
            {
                foreach($ingredients as $ingredient)
                {
                    $ingredient->delete();
                }
            }

            $cookbookitem->delete();
            return redirect()->back()->with('success', 'Deleted Successfully');

        }else{
            return view('backend.permission.permission');
        }
    }
}
