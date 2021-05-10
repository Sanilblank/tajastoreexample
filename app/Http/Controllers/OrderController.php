<?php

namespace App\Http\Controllers;

use App\Models\DelieveryAddress;
use App\Models\Order;
use App\Models\OrderedProducts;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->can('manage-order')){
            $neworder = DB::table('notifications')->where('type','App\Notifications\NewOrderNotification')->where('is_read', 0)->get();
            foreach ($neworder as $order) {
                DB::update('update notifications set is_read = 1 where id = ?', [$order->id]);
            }

            if ($request->ajax()) {
                $data = Order::latest()->with('user')->with('status')->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('customer', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            if($row->user_id == 1)
                            {
                                $admin = "(Made by Admin)";
                            }
                            else{
                                $admin = "";
                            }
                            $customer = $delievery_address->firstname.' '. $delievery_address->lastname . "<br>" .$admin;
                            return $customer;
                        })
                        ->addColumn('address', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            $address = $delievery_address->address. ', '. $delievery_address->district;
                            return $address;
                        })
                        ->addColumn('phone', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            return $delievery_address->phone;
                        })
                        ->addColumn('email', function($row) {
                            $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                            return $delievery_address->email;
                        })
                        ->addColumn('date', function($row) {
                            $date = date('F j, Y', strtotime($row->created_at));
                            return $date;
                        })
                        ->addColumn('status', function($row) {
                            if ($row->status_id == 5) {
                                $date = '<span class="badge bg-green">'.$row->status->status.'</span>';
                            }elseif ($row->status_id == 6) {
                                $date = '<span class="badge bg-red">'.$row->status->status.'</span>';
                            }else {
                                $date = '<span class="badge bg-warning">'.$row->status->status.'</span>';
                            }
                            return $date;
                        })
                        ->addColumn('action', function($row){
                            $showurl = route('order.show', $row->id);
                            $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Order</a>";

                            return $btn;
                        })
                        ->rawColumns(['customer','address', 'phone', 'email', 'status', 'action'])
                        ->make(true);
            }
            return view('backend.order.index');
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
        if($request->user()->can('manage-order')){
            $products = Product::latest()->where('unit_info', '>', 0)->get();
            return view('backend.order.create', compact('products'));
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
    }

    public function productorder(Request $request)
    {
        if($request->user()->can('manage-order')){

            //dd($request['product_id']);
            //dd($request['unit_info']);
           $data = $this->validate($request, [
                'firstname'=>'required',
                'lastname'=>'required',
                'address'=>'required',
                'town'=>'required',
                'district'=>'required',
                'postcode'=>'required',
                'phone'=>'required',
                'email'=>'required',
                'product_id'=>'required',
                // 'unit_info'=>'required',
           ]);
            // $noofproducts = count($data['product_id']);
            // $unitinfo = explode(',' , $request['unit_info']);
            // $noofquantity = count($unitinfo);
            // if($noofproducts != $noofquantity)
            // {
            //     return redirect()->back()->with('failure', 'No of product and no of quanitity dont match.');
            // }

            // $j = 0;
            // foreach($data['product_id'] as $product_id)
            // {
            //     $product = Product::where('id', $product_id)->first();
            //     if($unitinfo[$j] > $product->unit_info)
            //     {
            //         return redirect()->back()->with('failure', 'Insufficient Quantity.');
            //     }
            //     else{
            //         $j = $j + 1;
            //     }
            // }

            $delievery_address = DelieveryAddress::create([
                'user_id'=>1,
                'firstname'=>$data['firstname'],
                'lastname'=>$data['lastname'],
                'address'=>$data['address'],
                'town'=>$data['town'],
                'district'=>$data['district'],
                'postcode'=>$data['postcode'],
                'phone'=>$data['phone'],
                'email'=>$data['email'],
                'is_default'=>0,
            ]);
            $delievery_address->save();

            $order = Order::create([
                'user_id'=>1,
                'delievery_address_id'=>$delievery_address['id'],
                'status_id'=>1,
            ]);
            $order->save();

            $i = 0;
            foreach($data['product_id'] as $product_id)
            {
                $product = Product::findorfail($product_id);
                $orderedproduct = OrderedProducts::create([
                    'user_id'=>1,
                    'order_id'=>$order['id'],
                    'vendor_id'=>$product->vendor_id,
                    'product_id'=>$product->id,
                    'quantity'=>1,
                    'price'=>$product->price,
                    'status_id'=>1
                ]);
                $orderedproduct->save();
                $product->update([
                    'unit_info'=>$product->unit_info - 1,
                ]);

                $i = $i + 1;
            }

            return redirect()->route('order.index')->with('success', 'Order Added Successfully');


        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findorFail($id);
        $ordered_products = OrderedProducts::where('order_id', $order->id)->with('product')->with('status')->get();
        $noncancelledorderedproducts = OrderedProducts::where('order_id', $order->id)->where('status_id', '!=', 6)->with('product')->with('status')->get();
        $delievery_address = DelieveryAddress::where('id', $order->delievery_address_id)->first();
        $orderstatuses = OrderStatus::get();
        return view('backend.order.show', compact('order', 'ordered_products', 'delievery_address', 'orderstatuses', 'noncancelledorderedproducts'));
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
    public function notificationsread()
    {
        $notifications = DB::table('notifications')->where('is_read', 0)->get();
        foreach ($notifications as $notification) {
            DB::update('update notifications set is_read = 1 where id = ?', [$notification->id]);
        }

        return redirect()->back();
    }

    public function editaddress(Request $request, $id)
    {
        $delievery_address = DelieveryAddress::findorFail($id);

        $data = $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'town' => 'required',
            'district' => 'required',
        ]);

        $delievery_address->update([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'town' => $data['town'],
            'district' => $data['district'],
        ]);

        return redirect()->back()->with('success', 'Delevery address details updated successfully.');
    }

    public function deletefromorder($id)
    {
        $ordered_product = OrderedProducts::findorFail($id);
        $product = Product::where('id', $ordered_product->product_id)->first();
        $new_quantity = $product->unit_info + $ordered_product->quantity;

        $product->update([
            'unit_info' => $new_quantity
        ]);

        $ordered_product->update([
            'status_id' => 6,
            'reason' => 'Cancelled from admin side.'
        ]);

        return redirect()->back()->with('success', 'Product is cancelled from order.');
    }

    public function updatequantityadmin(Request $request, $id)
    {
        $ordered_product = OrderedProducts::findorFail($id);

        $product = Product::where('id', $ordered_product->product_id)->first();
        $total_quantity = $ordered_product->quantity + $product->unit_info;

        if ($total_quantity < $request['quantity']) {
            return redirect()->back()->with('failure', 'Quantity cannot be more than available.');
        } else {
            if ($request['quantity'] > $ordered_product->quantity) {
                $more_to_add = $request['quantity'] - $ordered_product->quantity;
                $new_quantity = $product->unit_info - $more_to_add;
                $product->update([
                    'unit_info' => $new_quantity
                ]);
            } elseif ($request['quantity'] < $ordered_product->quantity) {
                $product_to_deduct = $ordered_product->quantity - $request['quantity'];
                $new_quantity = $product->unit_info + $product_to_deduct;
                $product->update([
                    'unit_info' => $new_quantity
                ]);
            }
        }
        $ordered_product->update([
            'quantity' => $request['quantity']
        ]);

        return redirect()->back()->with('success', 'Quantity is updated successfully.');
    }

    public function changeOrderStatus(Request $request, $id)
    {
        $order = Order::findorFail($id);
        $ordered_products = OrderedProducts::where('order_id', $order->id)->get();

        foreach ($ordered_products as $ordered_product) {
            if($ordered_product->status_id != 6){
                if ($request['status_id'] == 6) {
                    $this->validate($request, [
                        'reason' => 'required'
                    ]);
                    $product = Product::where('id', $ordered_product->product_id)->first();
                    $newstock = $product->unit_info + $ordered_product->quantity;

                    $product->update([
                        'unit_info' => $newstock
                    ]);

                    $ordered_product->update([
                        'status_id' => $request['status_id'],
                        'reason' => $request['reason'],
                    ]);
                } else {
                    $ordered_product->update([
                        'status_id' => $request['status_id']
                    ]);
                }
            }
        }
        $order->update([
            'status_id' => $request['status_id']
        ]);

        return redirect()->back()->with('success', 'Order Status is updated successfully.');
    }

    public function addproductorder(Request $request)
    {
        $data = $this->validate($request, [
            'product_id'=>'required',
            'order_id'=>'required'
        ]);
        $order = Order::findorfail($data['order_id']);
        $product = Product::where('id', $data['product_id'])->where('unit_info', '>', 0)->first();
        if($product)
        {
            $orderproduct = OrderedProducts::create([
            'user_id'=>$order->user_id,
            'order_id'=>$data['order_id'],
            'vendor_id'=>$product->vendor_id,
            'product_id'=>$product->id,
            'quantity'=>1,
            'price'=>$product->price,
            'status_id'=>$order->status_id,
        ]);
            $orderproduct->save();

            $newquantity = $product->unit_info - 1;
            $product->update([
                'unit_info'=>$newquantity,
                ]);
            return redirect()->back()->with('success', 'Product Successfully Added');
        }
        else{
            return redirect()->back()->with('failure', 'Product Quantity is not sufficient');
        }

    }
}
