<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VendorProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $vendor = Vendor::where('name', $user->name)->where('email', $user->email)->first();
        if ($request->ajax()) {
            $data = Product::latest()->where('vendor_id', $vendor->id)->with('vendor')->with('subcategory')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    $productimagecount = ProductImage::where('product_id', $row->id)->count();
                    if ($productimagecount == 0) {
                        $imageurl = Storage::disk('uploads')->url('noimage.png');
                    } else {
                        $images = ProductImage::where('product_id', $row->id)->first();
                        $imageurl = Storage::disk('uploads')->url($images->filename);
                    }
                    $image = "<img src='$imageurl'style = 'max-height:100px'>";
                    return $image;
                })
                ->addColumn('subcategory', function ($row) {
                    $subcategory = $row->subcategory->title;
                    return $subcategory;
                })
                ->addColumn('costprice', function ($row) {
                    $costprice = 'Rs. ' . $row->bought_price;
                    return $costprice;
                })
                ->addColumn('sellingprice', function ($row) {
                    $sellingprice = 'Rs. ' . $row->price;
                    return $sellingprice;
                })
                ->addColumn('stock', function ($row) {
                    $stock = $row->unit_info;
                    return $stock;
                })
                ->addColumn('info', function ($row) {
                    $info = $row->title . '<br>( ' . $row->quantity . ' ' . $row->unit . ')';
                    return $info;
                })
                ->addColumn('action', function ($row) {
                    $editurl = route('singlevendorproduct.edit', $row->id);
                    $deleteurl = route('singlevendorproduct.destroy', $row->id);
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
                ->rawColumns(['image', 'subcategory', 'costprice', 'sellingprice', 'stock', 'info', 'action'])
                ->make(true);
        }
        return view('backend.singlevendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategory::all();
        return view('backend.singlevendor.product.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $vendor = Vendor::where('name', $user->name)->where('email', $user->email)->first();
        $data = $this->validate($request, [
            // 'vendor' => 'required',
            'subcategory' => 'required',
            'title' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'shipping' => 'required',
            'details' => 'required',
            'status' => 'required',
            'featured' => 'required',
            'stock' => 'required',
            'bought_price' => 'required',
            'photos' => 'required',
            'photos.*' => 'mimes:jpg,jpeg,png'
        ]);

        $product = Product::create([
            'vendor_id' => $vendor->id,
            'subcategory_id' => $data['subcategory'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'price' => $data['price'],
            'discount' => $data['discount'],
            'quantity' => $data['quantity'],
            'unit' => $data['unit'],
            'shipping' => $data['shipping'],
            'details' => $data['details'],
            'status' => $data['status'],
            'featured' => $data['featured'],
            'unit_info' => $data['stock'],
            'bought_price' => $data['bought_price'],
        ]);
        $imagename = '';
        if ($request->hasfile('photos')) {
            $images = $request->file('photos');
            foreach ($images as $image) {
                $imagename = $image->store('product_images', 'uploads');
                $productimage = ProductImage::create([
                    'product_id' => $product['id'],
                    'filename' => $imagename,
                ]);
                $productimage->save();
            }
        }
        $product->save();
        return redirect()->route('singlevendorproduct.index')->with('success', 'Product information created successfully.');
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
        $product = Product::findorFail($id);
        $product_images = ProductImage::where('product_id', $product->id)->get();
        $subcategories = Subcategory::all();
        return view('backend.singlevendor.product.edit', compact('product', 'subcategories', 'product_images'));
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
        $user = User::where('id', Auth::user()->id)->first();
        $vendor = Vendor::where('name', $user->name)->where('email', $user->email)->first();
        $product = Product::findorFail($id);
        $data = $this->validate($request, [
            // 'vendor_id' => 'required',
            'subcategory_id' => 'required',
            'title' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'shipping' => 'required',
            'details' => 'required',
            'status' => 'required',
            'featured' => 'required',
            'stock' => 'required',
            'bought_price' => 'required',
            // 'photos' =>'',
            // 'photos.*' => 'mimes:jpg,jpeg,png'
        ]);
        $product->update([
            'vendor_id' => $vendor->id,
            'subcategory_id' => $data['subcategory_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'price' => $data['price'],
            'discount' => $data['discount'],
            'quantity' => $data['quantity'],
            'unit' => $data['unit'],
            'shipping' => $data['shipping'],
            'details' => $data['details'],
            'status' => $data['status'],
            'featured' => $data['featured'],
            'unit_info' => $data['stock'],
            'bought_price' => $data['bought_price'],
        ]);
        $product->save();
        return redirect()->route('singlevendorproduct.index')->with('success', 'Product successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorFail($id);
        $product_images = ProductImage::where('product_id', $product->id)->get();
        foreach ($product_images as $image) {
            Storage::disk('uploads')->delete($image->filename);
            $image->delete();
        }
        $product->delete();
        return redirect()->route('singlevendorproduct.index')->with('success', 'Product Successfully Deleted');
    }
}
