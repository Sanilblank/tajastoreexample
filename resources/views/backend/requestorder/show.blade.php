@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="right_col" role="main">
    <!-- MAIN -->
    @if (session('success'))
    <div class="col-sm-12">
        <div class="alert  alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('failure'))
    <div class="col-sm-12">
        <div class="alert  alert-danger alert-dismissible fade show" role="alert">
            {{ session('failure') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif

    <h1 class="mt-3">Request Order no. {{$requestorder->id}} <a href="{{route('requestorder.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i> View All Requests</a> </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <p style="font-weight: bold;">Request Order Id: </p>
                        </div>
                        <div class="col-md-10">
                            <p> {{$requestorder->id}}</p>
                        </div>
                            <div class="col-md-2">
                                <p style="font-weight: bold;">Name: </p>
                            </div>
                        <div class="col-md-10">
                            <p> {{$requestorder->name}}</p>
                        </div>
                            <div class="col-md-2">
                                <p style="font-weight: bold;">Customer Email: </p>
                            </div>
                        <div class="col-md-10">
                            <p>{{$requestorder->email}}</p>
                        </div>
                            <div class="col-md-2">
                                <p style="font-weight: bold;">Address: </p>
                            </div>
                        <div class="col-md-10">
                            <p>{{$requestorder->address}}</p>
                        </div>
                            <div class="col-md-2">
                                <p style="font-weight: bold;">Customer contact: </p>
                            </div>
                        <div class="col-md-10">
                            <p>{{$requestorder->phone}}</p>
                        </div>
                            <div class="col-md-2">
                                <p style="font-weight: bold;">Date Requested: </p>
                            </div>
                        <div class="col-md-10">
                            <p> {{date('F d, Y', strtotime($requestorder->created_at))}}</p>
                        </div>
                        <div class="col-md-2">
                            <p style="font-weight: bold;">Request Status: </p>
                        </div>
                        <div class="col-md-10">
                            <p> {{$requestorder->status}}</p>
                        </div>
                        <div class="col-md-2">
                            <p style="font-weight: bold;">Product Name: </p>
                        </div>
                        <div class="col-md-10">
                            <p> {{$requestorder->product}}</p>
                        </div>
                        <div class="col-md-12">
                            <p style="font-weight: bold;">Description: </p>
                        </div>
                        <div class="col-md-12">
                            <p> {{$requestorder->description}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6>Change Status</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('requestorder.update', $requestorder->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="Pending" {{$requestorder->status == "Pending" ? 'selected':''}}>Pending</option>
                                            <option value="Approved" {{$requestorder->status == "Approved" ? 'selected':''}}>Approved</option>
                                            <option value="Declined" {{$requestorder->status == "Declined" ? 'selected':''}}>Declined</option>
                                            <option value="Delivered" {{$requestorder->status == "Delivered" ? 'selected':''}}>Delivered</option>

                                        </select>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>



    </div>
</div>
@endsection
@push('scripts')

@endpush
