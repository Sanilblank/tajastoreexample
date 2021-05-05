<?php

namespace App\Http\Controllers;

use App\Models\DelieveryAddress;
use App\Models\Order;
use App\Models\OrderedProducts;
use App\Models\OrderStatus;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VendorOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $vendororder = Vendor::where('name', Auth::user()->name)->where('email', Auth::user()->email)->first();
        $neworder = DB::table('notifications')->where('type', 'App\Notifications\NewOrderedProduct')->where('is_read', 0)->where('vendor_id', $vendororder->id)->get();
        foreach ($neworder as $order) {
            DB::update('update notifications set is_read = 1 where id = ?', [$order->id]);
        }


        if ($request->ajax()) {
            $user = User::where('id', Auth::user()->id)->first();
            $vendor = Vendor::where('name', $user->name)->where('email', $user->email)->first();
            $data = OrderedProducts::latest()->where('vendor_id', $vendor->id)->with('status')->with('product')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('customer', function ($row) {
                    $order = Order::where('id', $row->order_id)->first();
                    $delievery_address = DelieveryAddress::where('id', $order->delievery_address_id)->first();
                    $customer = $delievery_address->firstname . ' ' . $delievery_address->lastname;
                    return $customer;
                })
                ->addColumn('info', function ($row) {
                    $info = $row->product->title . '<br>( ' . $row->product->quantity . ' ' . $row->product->unit . ')';
                    return $info;
                })
                ->addColumn('image', function ($row) {
                    $productimagecount = ProductImage::where('product_id', $row->product_id)->count();
                    if ($productimagecount == 0) {
                        $imageurl = Storage::disk('uploads')->url('noimage.png');
                    } else {
                        $images = ProductImage::where('product_id', $row->product_id)->first();
                        $imageurl = Storage::disk('uploads')->url($images->filename);
                    }
                    $image = "<img src='$imageurl'style = 'max-height:100px'>";
                    return $image;
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
                ->addColumn('action', function ($row) {
                    $showurl = route('singlevendororder.show', $row->id);
                    $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Order</a>";

                    return $btn;
                })
                ->rawColumns(['customer', 'image', 'info', 'status', 'action'])
                ->make(true);
        }
        return view('backend.singlevendor.order.index');
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
    public function show($id)
    {
        $ordered_product = OrderedProducts::where('id', $id)->with('product')->with('status')->first();
        $order = Order::where('id', $ordered_product->order_id)->first();
        $delievery_address = DelieveryAddress::where('id', $order->delievery_address_id)->first();
        $orderstatuses = OrderStatus::get();
        return view('backend.singlevendor.order.show', compact('order', 'ordered_product', 'delievery_address', 'orderstatuses'));
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
