@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="right_col" role="main">
    <h1 class="mt-3">Edit category  <a href="{{route('category.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> View categories</a></h1>
    <div class="card mt-3">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('category.update', $category->id)}}" method="POST" class="bg-light p-3">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Category Title: </label>
                        <input type="text" name="title" class="form-control" value="{{$category->title}}" placeholder="Enter Category Title">
                        @error('title')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status">Status: </label>
                                <input type="radio" name="status"  value="1" {{$category->status == 1 ? 'checked': ''}}> Approved
                                <input type="radio" name="status"  value="0" {{$category->status == 0 ? 'checked': ''}}> Not Approved
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="featured">Featured: </label>
                                <input type="radio" name="featured"  value="1" {{$category->featured == 1 ? 'checked': ''}}> Yes
                                <input type="radio" name="featured"  value="0" {{$category->featured == 0 ? 'checked': ''}}> No
                            </div>
                        </div>
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
