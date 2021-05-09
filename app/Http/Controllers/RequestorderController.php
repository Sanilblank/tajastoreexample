<?php

namespace App\Http\Controllers;

use App\Models\Requestorder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class RequestorderController extends Controller
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
            $newrequest = DB::table('notifications')->where('type','App\Notifications\RequestOrderNotification')->where('is_read', 0)->get();
            foreach ($newrequest as $order) {
                DB::update('update notifications set is_read = 1 where id = ?', [$order->id]);
            }

            if ($request->ajax()) {
                $data = Requestorder::latest()->get();
                return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('status', function($row){
                            if($row->status == "Pending")
                            {
                                $status = '<span class="badge bg-warning">Pending</span>';
                            }
                            elseif($row->status == "Approved")
                            {
                                $status = '<span class="badge bg-success">Approved</span>';
                            }
                            elseif($row->status == "Declined")
                            {
                                $status = '<span class="badge bg-danger">Declined</span>';
                            }
                            elseif($row->status == "Delivered")
                            {
                                $status = '<span class="badge bg-primary">Delivered</span>';
                            }

                            return $status;
                        })
                        ->addColumn('action', function($row){
                            $showurl = route('requestorder.show', $row->id);
                            $btn = "<a href='$showurl' class='edit btn btn-primary btn-sm'>View Request</a>";

                            return $btn;
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true);
            }
            return view('backend.requestorder.index');
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
     * @param  \App\Models\Requestorder  $requestorder
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        if($request->user()->can('manage-order')){
            $requestorder = Requestorder::findorfail($id);
            return view('backend.requestorder.show', compact('requestorder'));
        }else{
            return view('backend.permission.permission');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requestorder  $requestorder
     * @return \Illuminate\Http\Response
     */
    public function edit(Requestorder $requestorder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requestorder  $requestorder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $requestorder = Requestorder::findorfail($id);
        $data = $this->validate($request, [
            'status'=>'required'
        ]);
        $requestorder->update([
            'status'=>$data['status']
        ]);
            return redirect()->route('requestorder.index')->with('success', 'Updated Status Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Requestorder  $requestorder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requestorder $requestorder)
    {
        //
    }
}
