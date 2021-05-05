<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Review;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    //
    public function getreviews(Request $request)
    {
        if($request->user()->can('manage-review')){
            if ($request->ajax()) {
                $data = Review::latest()->with('user')->with('product')->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('image', function($row){
                            $productimage= ProductImage::where('product_id', $row->product_id)->first();
                            $imageurl = Storage::disk('uploads')->url($productimage->filename);
                            $image = "<img src='$imageurl'style = 'max-height:100px'>";
                            return $image;
                        })
                        ->addColumn('product', function($row){
                            $product = $row->product->title;
                            return $product;
                        })



                        ->addColumn('action', function($row){

                                $enableurl = route('review.enable', $row->id);
                                $disableurl = route('review.disable', $row->id);
                                $csrf_token = csrf_token();

                                if($row->disable == 1)
                                {
                                    $btn = "
                                        <form action='$enableurl' method='POST' style='display:inline;'>
                                        <input type='hidden' name='_token' value='$csrf_token'>
                                        <input type='hidden' name='_method' value='PUT' />
                                            <button type='submit' class='btn btn-danger btn-sm'>Enable</button>
                                        </form>
                                    ";
                                }
                                else
                                {
                                    $btn = "
                                        <form action='$disableurl' method='POST' style='display:inline;'>
                                        <input type='hidden' name='_token' value='$csrf_token'>
                                        <input type='hidden' name='_method' value='PUT' />
                                            <button type='submit' class='btn btn-success btn-sm'>Disable</button>
                                        </form>
                                    ";
                                }


                            return $btn;
                        })
                        ->rawColumns(['product', 'image', 'action'])
                        ->make(true);
            }
            return view('backend.review.index');
        }else{
            return view('backend.permission.permission');
        }
    }

    public function enableurl(Request $request, $id)
      {
        if($request->user()->can('manage-review')){
            $review = Review::findorfail($id);
            $review->update([
                'disable'=>null,
            ]);
            return redirect()->back()->with('success', 'Review Enabled');

        }else{
            return view('backend.permission.permission');
        }
      }

      public function disableurl(Request $request, $id)
      {
        if($request->user()->can('manage-review')){
            $review = Review::findorfail($id);
            $review->update([
                'disable'=>1,
            ]);
            return redirect()->back()->with('success', 'Review Disabled');

        }else{
            return view('backend.permission.permission');
        }

      }

}
