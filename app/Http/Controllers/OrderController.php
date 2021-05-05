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
        if ($request->user()->can('manage-order')) {
            $neworder = DB::table('notifications')->where('type', 'App\Notifications\NewOrderNotification')->where('is_read', 0)->get();
            foreach ($neworder as $order) {
                DB::update('update notifications set is_read = 1 where id = ?', [$order->id]);
            }

            if ($request->ajax()) {
                $data = Order::latest()->with('user')->with('status')->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('customer', function ($row) {
                        $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                        $customer = $delievery_address->firstname . ' ' . $delievery_address->lastname;
                        return $customer;
                    })
                    ->addColumn('address', function ($row) {
                        $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                        $address = $delievery_address->address . ', ' . $delievery_address->district;
                        return $address;
                    })
                    ->addColumn('phone', function ($row) {
                        $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                        return $delievery_address->phone;
                    })
                    ->addColumn('email', function ($row) {
                        $delievery_address = DelieveryAddress::where('id', $row->delievery_address_id)->first();
                        return $delievery_address->email;
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
                        $showurl = route('order.show', $row->id);
                        $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Order</a>";

                        return $btn;
                    })
                    ->rawColumns(['customer', 'address', 'phone', 'email', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.order.index');
        } else {
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
    public function show($id)
    {
        $order = Order::findorFail($id);
        $ordered_products = OrderedProducts::where('order_id', $order->id)->with('product')->with('status')->get();
        $delievery_address = DelieveryAddress::where('id', $order->delievery_address_id)->first();
        $orderstatuses = OrderStatus::get();
        return view('backend.order.show', compact('order', 'ordered_products', 'delievery_address', 'orderstatuses'));
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
        $order->update([
            'status_id' => $request['status_id']
        ]);

        return redirect()->back()->with('success', 'Order Status is updated successfully.');
    }
}
