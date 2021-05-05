<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
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
            $setting = Setting::first();
            return view('backend.setting.index', compact('setting'));
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $setting = Setting::findorfail($id);
        $data = $this->validate($request, [
            'sitename' => 'required',
            'headerImage' => 'mimes:jpg,png,jpeg',
            'footerImage' => 'mimes:jpeg,png,jpg',
            'aboutus' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        $headerimage = '';
        if ($request->hasFile('headerImage')) {
            Storage::disk('uploads')->delete($setting->headerImage);
            $headerimage = $request->file('headerImage')->store('header_image', 'uploads');
        } else {
            $headerimage = $setting->headerImage;
        }

        $footerimage = '';
        if ($request->hasFile('footerImage')) {
            Storage::disk('uploads')->delete($setting->footerImage);
            $footerimage = $request->file('footerImage')->store('footer_image', 'uploads');
        } else {
            $footerimage = $setting->footerImage;
        }

        $setting->update([
            'sitename' => $data['sitename'],
            'headerImage' => $headerimage,
            'footerImage' => $footerimage,
            'facebook' => $request['facebook'],
            'linkedin' => $request['linkedin'],
            'youtube' => $request['youtube'],
            'instagram' => $request['instagram'],
            'aboutus' => $data['aboutus'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        return redirect()->route('setting.index')->with('success', 'Settings information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
