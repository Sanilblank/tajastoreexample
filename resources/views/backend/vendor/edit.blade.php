@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="right_col" role="main">
    <h1 class="mt-3">Edit Vendor  <a href="{{route('vendor.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> View Vendors</a></h1>
    <div class="card mt-3">
            <form action="{{route('vendor.update', $vendor->id)}}" method="POST" class="bg-light p-3">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Vendor Name: </label>
                            <input type="text" name="name" class="form-control" value="{{$vendor->name}}" placeholder="Enter Vendor's Name">
                            @error('name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Vendor Address: </label>
                            <input type="text" name="address" class="form-control" value="{{$vendor->address}}" placeholder="Enter Vendor's Address">
                            @error('address')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district">Vendor District: </label>
                            <input type="text" name="district" class="form-control" value="{{$vendor->district}}" placeholder="Enter Vendor's District">
                            @error('district')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Vendor E-mail: </label>
                            <input type="text" name="email" class="form-control" value="{{$vendor->email}}" placeholder="Enter Vendor's E-mail">
                            @error('email')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Vendor Phone: </label>
                            <input type="text" name="phone" class="form-control" value="{{$vendor->phone}}" placeholder="Enter Vendor's Phone">
                            @error('phone')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
    </div>
</div>

@endsection
@push('scripts')

@endpush
