@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="right_col" role="main">
    <h1 class="mt-3">Create Permission  <a href="{{route('permission.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> View Permissions</a></h1>
    <div class="card mt-3">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('permission.store')}}" method="POST" class="bg-light p-3">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Permission Name: </label>
                        <input type="text" name="name" class="form-control" value="{{@old('name')}}" placeholder="Enter Permission Name">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

@endpush
