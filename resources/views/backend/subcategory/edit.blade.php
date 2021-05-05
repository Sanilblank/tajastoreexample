@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Edit Subcategory <a href="{{ route('subcategory.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Subcategories</a></h1>
        <div class="card mt-3">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('subcategory.update', $subcategory->id) }}" method="POST" class="bg-light p-3"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="category">Select Category</label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Subcategory Title: </label>
                            <input type="text" name="title" class="form-control" value="{{ $subcategory->title }}"
                                placeholder="Enter Subcategory Title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="subcategory_image">Subcategory Image: </label>
                            <input type="file" name="subcategory_image" class="form-control">
                            @error('subcategory_image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="text-success">Please do not select new image if you want previous image.</div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Status: </label>
                                    <input type="radio" name="status" value="1"
                                        {{ $subcategory->status == 1 ? 'checked' : '' }}> Approved
                                    <input type="radio" name="status" value="0"
                                        {{ $subcategory->status == 0 ? 'checked' : '' }}> Not Approved
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="featured">Featured: </label>
                                    <input type="radio" name="featured" value="1"
                                        {{ $subcategory->featured == 1 ? 'checked' : '' }}> Yes
                                    <input type="radio" name="featured" value="0"
                                        {{ $subcategory->featured == 0 ? 'checked' : '' }}> No
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
