<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->user()->can('manage-setting')){
            if ($request->ajax()) {
                $data = Slider::latest()->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('images', function($row){
                            $images = Slider::where('id', $row->id)->first();
                            $src = Storage::disk('uploads')->url($images->images);

                        $image = "<img src='$src' style='max-height:100px'>";
                        return $image;
                    })
                    ->addColumn('description', function($row){
                        $description = substr($row->description, 0, 16) .  '....';
                        return $description;
                    })
                    ->addColumn('action', function($row){
                        $editurl = route('slider.edit', $row->id);
                        $deleteurl = route('slider.destroy', $row->id);
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
                    ->rawColumns(['images', 'description', 'action'])
                    ->make(true);
            }

            return view('backend.slider.index');
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
        if($request->user()->can('manage-setting')){
            return view('backend.slider.create');
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
            'subtitle' => 'required',
            'title' =>'required',
            'description'=>'required',
            'images' =>'required',
            'images.*' => 'mimes:jpg,jpeg,png'
        ]);

        $imagename = '';
        if($request->hasfile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $imagename = $image->store('slider_images', 'uploads');

                $slider = Slider::create([
                    'subtitle' => $data['subtitle'],
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'images' => $imagename,
                ]);
                $slider->save();
            }
        }
        return redirect()->route('slider.index')->with('success', 'Slider Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        if($request->user()->can('manage-setting')){
            $slider = Slider::findorfail($id);
            return view('backend.slider.edit', compact('slider'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $slider = Slider::findorfail($id);
        $data = $this->validate($request, [
            'subtitle' => 'required',
            'title' =>'required',
            'description'=>'required',
        ]);

        $imagename = '';
        if($request->hasfile('images')){
            $images = $request->file('images');
            Storage::disk('uploads')->delete($slider->images);

                $imagename = $images->store('slider_images', 'uploads');

                $slider->update([
                    'subtitle' => $data['subtitle'],
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'images' => $imagename,
                ]);

        }
        else {
            $imagename = $slider->images;
            $slider->update([
                'subtitle' => $data['subtitle'],
                'title' => $data['title'],
                'description' => $data['description'],
                'images' => $imagename,
            ]);
        }
        return redirect()->route('slider.index')->with('success', 'Slider Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        if($request->user()->can('manage-setting')){
            $slider = Slider::findorfail($id);
            Storage::disk('uploads')->delete($slider->images);
            $slider->delete();
            return redirect()->route('slider.index')->with('success', 'Slider Successfully Deleted');

        }else{
            return view('backend.permission.permission');
        }
    }
}
