<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\Vendor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->can('manage-product')) {
            if ($request->ajax()) {
                $data = Product::latest()->with('vendor')->with('subcategory')->get();
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
                    ->addColumn('vendor', function ($row) {
                        $vendor = $row->vendor->name;
                        return $vendor;
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
                    ->addColumn('status', function ($row) {
                        if($row->status == 1)
                        {
                            $status = '<span class="badge bg-green" style="background-color: green";>Approved</span>';
                        }
                        else
                        {
                            $status = '<span class="badge bg-danger" style="color: white";>Not Approved</span>';
                        }
                        return $status;
                    })
                    ->addColumn('action', function ($row) {
                        $editurl = route('product.edit', $row->id);
                        $deleteurl = route('product.destroy', $row->id);
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
                    ->rawColumns(['image', 'vendor', 'subcategory', 'costprice', 'sellingprice', 'stock', 'info', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.product.index');
        } else {
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
        if ($request->user()->can('manage-product')) {
            $vendors = Vendor::all();
            $subcategories = Subcategory::all();
            return view('backend.product.create', compact('vendors', 'subcategories'));
        } else {
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
        if ($request->user()->can('manage-product')) {
            $data = $this->validate($request, [
                'vendor' => 'required',
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

            $existingproduct = Product::where('vendor_id', $data['vendor'])
                                        ->where('subcategory_id', $data['subcategory'])
                                        ->where('title', $data['title'])
                                        ->where('quantity', $data['quantity'])
                                        ->where('unit', $data['unit'])->first();
            if($existingproduct)
            {
                return redirect()->back()->with('failure', 'Same product exists. Please edit it.');
            }


            $product = Product::create([
                'vendor_id' => $data['vendor'],
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
            FrontController::sendsubscribermail($product->id);
            return redirect()->route('product.index')->with('success', 'Product information created successfully.');
        } else {
            return view('backend.permission.permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if ($request->user()->can('manage-product')) {
            $product = Product::findorFail($id);
            $vendors = Vendor::all();
            $product_images = ProductImage::where('product_id', $product->id)->get();
            $subcategories = Subcategory::all();
            return view('backend.product.edit', compact('product', 'vendors', 'subcategories', 'product_images'));
        } else {
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->user()->can('manage-product')) {
            $product = Product::findorFail($id);
            $data = $this->validate($request, [
                'vendor_id' => 'required',
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
                'vendor_id' => $data['vendor_id'],
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
            return redirect()->route('product.index')->with('success', 'Product successfully Updated');
        } else {
            return view('backend.permission.permission');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->user()->can('manage-product')) {
            $product = Product::findorFail($id);
            $product_images = ProductImage::where('product_id', $product->id)->get();
            foreach ($product_images as $image) {
                Storage::disk('uploads')->delete($image->filename);
                $image->delete();
            }
            $product->delete();
            return redirect()->route('product.index')->with('success', 'Product Successfully Deleted');
        } else {
            return view('backend.permission.permission');
        }
    }

    public function deleteproductimage($id)
    {
        $productimage = ProductImage::findorFail($id);
        Storage::disk('uploads')->delete($productimage->filename);
        $productimage->delete();

        return redirect()->back()->with('success', 'Product image deleted successfully.');
    }

    public function addmoreproductimages(Request $request, $id)
    {
        // dd($request['screenshots']);
        $this->validate($request, [
            'photos' => 'required',
            'photos.*' => 'required|mimes:jpg,jpeg,png',
        ]);

        $imagename = '';
        if ($request->hasfile('photos')) {
            $images = $request->file('photos');
            foreach ($images as $image) {
                $imagename = $image->store('product_images', 'uploads');

                $product_image = ProductImage::create([
                    'product_id' => $id,
                    'filename' => $imagename,
                ]);
                $product_image->save();
            }
        }
        return redirect()->back()->with('success', 'Product images added successfully.');
    }
}
