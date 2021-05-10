<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderedProducts;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class CancelledproductController extends Controller
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
                $data = OrderedProducts::latest()->where('status_id', 6)->with('product')->with('vendor')->with('status')->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('username', function($row){
                            $user = User::findorfail($row->user_id);
                            return $user->name;
                        })
                        ->addColumn('vendor_id', function($row){

                            return $row->vendor->name;
                        })
                        ->addColumn('product_id', function($row){

                            return $row->product->title;
                        })
                        ->addColumn('image', function ($row) {

                            $images = ProductImage::where('product_id', $row->product_id)->first();
                            $imageurl = Storage::disk('uploads')->url($images->filename);

                            $image = "<img src='$imageurl'style = 'max-height:100px'>";
                            return $image;
                        })
                        ->addColumn('action', function($row){
                            $showurl = route('cancelledproduct.show', $row->id);
                            $cancelledshow = route('cancelledordershow', $row->id);
                            $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View All Orders</a>
                                    <a href='$cancelledshow' class='edit btn btn-danger btn-sm'>View Cancelled Orders</a>";

                            return $btn;
                        })
                        ->rawColumns(['username', 'image', 'action'])
                        ->make(true);
            }
            return view('backend.cancelledproduct.index');

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
    public function show(Request $request ,$id)
    {
        //
        if($request->user()->can('manage-order')){
            $cancelledorder = OrderedProducts::findorfail($id);
            $customer = User::findorfail($cancelledorder->user_id);
            if ($request->ajax()) {
                $data = OrderedProducts::latest()->where('user_id', $customer->id)->with('product')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($row) {
                        $images = ProductImage::where('product_id', $row->product_id)->first();
                        $imageurl = Storage::disk('uploads')->url($images->filename);
                        $image = "<img src='$imageurl'style = 'max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('subcategory', function ($row) {
                        $subcategory = Subcategory::where('id', $row->product->subcategory_id)->first();
                        $name = $subcategory->title;
                        return $name;
                    })
                    ->addColumn('price', function ($row) {
                        $price = 'Rs. ' . $row->price;
                        return $price;
                    })
                    ->addColumn('info', function ($row) {
                        $info = $row->product->title . '<br>( ' . $row->product->quantity . ' ' . $row->product->unit . ')';
                        return $info;
                    })
                    ->addColumn('date', function ($row) {
                        $date = date('F j, Y', strtotime($row->created_at));
                        return $date;
                    })
                    ->addColumn('status', function ($row) {
                        if ($row->status_id == 5) {
                            $date = '<span class="badge bg-green">' . $row->status->status . '</span>';
                        } elseif ($row->status_id == 6) {
                            $date = '<span class="badge bg-red">' . $row->status->status . '</span>';
                        } else {
                            $date = '<span class="badge bg-warning">' . $row->status->status . '</span>';
                        }
                        return $date;
                    })
                    // ->addColumn('action', function ($row) {
                    //     $showurl = route('order.show', $row->id);
                    //     $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Order</a>";

                    //     return $btn;
                    // })
                    ->rawColumns(['image', 'subcategory', 'price', 'info', 'date', 'status'])
                    ->make(true);
            }
            return view('backend.cancelledproduct.show', compact('customer', 'cancelledorder'));
        }else{
            return view('backend.permission.permission');
        }
    }

    public function cancelledordershow(Request $request ,$id)
    {
        if($request->user()->can('manage-order')){
            $cancelledorder = OrderedProducts::findorfail($id);
            $customer = User::findorfail($cancelledorder->user_id);
            if ($request->ajax()) {
                $data = OrderedProducts::latest()->where('user_id', $customer->id)->where('status_id', 6)->with('product')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function ($row) {
                        $images = ProductImage::where('product_id', $row->product_id)->first();
                        $imageurl = Storage::disk('uploads')->url($images->filename);
                        $image = "<img src='$imageurl'style = 'max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('subcategory', function ($row) {
                        $subcategory = Subcategory::where('id', $row->product->subcategory_id)->first();
                        $name = $subcategory->title;
                        return $name;
                    })
                    ->addColumn('price', function ($row) {
                        $price = 'Rs. ' . $row->price;
                        return $price;
                    })
                    ->addColumn('info', function ($row) {
                        $info = $row->product->title . '<br>( ' . $row->product->quantity . ' ' . $row->product->unit . ')';
                        return $info;
                    })
                    ->addColumn('date', function ($row) {
                        $date = date('F j, Y', strtotime($row->created_at));
                        return $date;
                    })

                    // ->addColumn('action', function ($row) {
                    //     $showurl = route('order.show', $row->id);
                    //     $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Order</a>";

                    //     return $btn;
                    // })
                    ->rawColumns(['image', 'subcategory', 'price', 'info', 'date'])
                    ->make(true);
            }
            return view('backend.cancelledproduct.cancelledshow', compact('customer', 'cancelledorder'));
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
