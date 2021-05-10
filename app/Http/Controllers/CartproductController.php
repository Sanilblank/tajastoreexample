<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class CartproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-order')){
            if ($request->ajax()) {
                $data = User::latest()->where('role_id', 3)->where('is_verified', 1)->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('logintype', function($row){
                            if($row->google_id != null)
                            {
                                $logintype = "Google";
                            }
                            elseif($row->facebook_id != null)
                            {
                                $logintype = "Facebook";
                            }
                            else{
                                $logintype = "Website Account";
                            }
                            return $logintype;
                        })
                        ->addColumn('noofitems', function($row){
                            $cartitems = Cart::where('user_id', $row->id)->sum('quantity');
                            return $cartitems;
                        })
                        ->addColumn('action', function($row){
                            $showurl = route('cartproduct.show', $row->id);
                            $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View User Cart</a>";

                            return $btn;
                        })
                        ->rawColumns(['logintype', 'noofitems', 'action'])
                        ->make(true);
            }

        return view('backend.cartproduct.index');
    }else{
        return view('backend.permission.permission');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $user = User::findorfail($id);
        if($request->user()->can('manage-order')){
            if ($request->ajax()) {
                $data = Cart::latest()->where('user_id', $id)->with('user')->with('product')->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($row) {

                        $images = ProductImage::where('product_id', $row->product_id)->first();
                        $imageurl = Storage::disk('uploads')->url($images->filename);

                        $image = "<img src='$imageurl'style = 'max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('name', function ($row) {
                        $name = $row->product->title;
                        return $name;
                    })
                    ->addColumn('subcategory', function ($row) {
                        $subcategory = $row->product->subcategory->title;
                        return $subcategory;
                    })
                    ->addColumn('costprice', function ($row) {
                        $costprice = 'Rs. ' . $row->product->bought_price;
                        return $costprice;
                    })
                    ->addColumn('sellingprice', function ($row) {
                        $sellingprice = 'Rs. ' . $row->product->price;
                        return $sellingprice;
                    })
                    ->addColumn('discount', function ($row) {
                        $discount = $row->product->discount . '%';
                        return $discount;
                    })
                    ->addColumn('stock', function ($row) {
                        $stock = $row->product->unit_info;
                        return $stock;
                    })

                    ->rawColumns(['image', 'name', 'subcategory' ,'costprice', 'sellingprice', 'discount'])
                    ->make(true);
            }
            return view('backend.cartproduct.show', compact('user'));

        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
