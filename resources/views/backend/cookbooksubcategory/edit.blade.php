@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Edit SubCategory => {{$subcategory->subcategory}} <a href="{{ route('cookbooksubcategory.index', $subcategory->navbar->id) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-eye" aria-hidden="true"></i> View SubCategories</a></h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('cookbooksubcategory.update', $subcategory->id) }}" method="POST" class="bg-light p-3"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" value="{{$subcategory->navbar->id}}" name="cookbooknavbar_id">
                                        <div class="form-group">
                                            <label for="cookbookcategory_id">Select Category</label>
                                            <select name="cookbookcategory_id" class="form-control">

                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->id }}" {{$item->id == $subcategory->cookbookcategory_id?'selected':''}}>{{ $item->category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="subcategory">SubCategory Title: </label>
                                            <input type="text" name="subcategory" class="form-control" value="{{ @old('subcategory')?@old('subcategory'):$subcategory->subcategory }}"
                                                placeholder="Enter Title">
                                            @error('subcategory')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Image: </label>
                                            <input type="file" name="image" class="form-control">
                                            @error('image')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror

                                        </div>
                                        <div class="text-danger">Please do not select new image if you want previous image.</div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="status">Status: </label>
                                                    <input type="radio" name="status" value="1" {{$subcategory->status==1?'checked':''}}> Active
                                                    <input type="radio" name="status" value="0" {{$subcategory->status==0?'checked':''}}> Inactive
                                                    @error('status')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>

@endsection
@push('scripts')

@endpush
