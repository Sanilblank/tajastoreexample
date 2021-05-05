@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"
        integrity="sha256-n3YISYddrZmGqrUgvpa3xzwZwcvvyaZco0PdOyUKA18=" crossorigin="anonymous" />
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="right_col" role="main">
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
        <h1 class="mt-3">Edit Product <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Products</a></h1>
        <div class="card mt-3">

            <form action="{{ route('product.update', $product->id) }}" method="POST" class="bg-light p-3"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vendor_id">Select Vendor</label>
                            <select name="vendor_id" class="form-control">
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}"
                                        {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>{{ $vendor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory_id">Select Subcategory</label>
                            <select name="subcategory_id" class="form-control">
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}"
                                        {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                        {{ $subcategory->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Product Title: </label>
                            <input type="text" name="title" class="form-control" value="{{ $product->title }}"
                                placeholder="Enter Product Title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="boought_price">Bought Price (From Vendor): </label>
                            <input type="text" name="bought_price" class="form-control" value="{{ $product->bought_price }}"
                                placeholder="Enter Bought Price">
                            @error('bought_price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price (Selling Price): </label>
                            <input type="text" name="price" class="form-control" value="{{ $product->price }}"
                                placeholder="Enter Selling Price">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock (Quantity): </label>
                            <input type="text" name="stock" class="form-control" value="{{ $product->unit_info }}"
                                placeholder="Enter number of quantity">
                            @error('stock')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="discount">Product Discount: </label>
                            <input type="text" name="discount" class="form-control" value="{{ $product->discount }}"
                                placeholder="Enter Product Discount">
                            @error('discount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Product Quantity: </label>
                                    <input type="text" name="quantity" class="form-control" value="{{ $product->quantity }}"
                                        placeholder="Enter Product Quantity">
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">Product Unit: </label>
                                    <input type="text" name="unit" class="form-control" value="{{ $product->unit }}"
                                        placeholder="Enter Product Unit">
                                    @error('unit')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="shipping">Product Shipping: </label>
                            <input type="text" name="shipping" class="form-control" value="{{ $product->shipping }}"
                                placeholder="Enter Product Shipping">
                            @error('shipping')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea name="details" class="form-control" id="details" cols="30" rows="10"
                                placeholder="Enter Product Details">{{ $product->details }}</textarea>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Status: </label>
                                    <input type="radio" name="status" value="1"
                                        {{ $product->status == 1 ? 'checked' : '' }}> Approved
                                    <input type="radio" name="status" value="0"
                                        {{ $product->status == 0 ? 'checked' : '' }}> Not Approved
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="featured">Featured: </label>
                                    <input type="radio" name="featured" value="1"
                                        {{ $product->featured == 1 ? 'checked' : '' }}> Yes
                                    <input type="radio" name="featured" value="0"
                                        {{ $product->featured == 0 ? 'checked' : '' }}> No
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <h3>Edit Product Images</h3>
            </div>
            <div class="card-body">
                @if (count($product_images) == 0)
                    No product images yet.
                @else
                    <div class="row">
                        @foreach ($product_images as $images)

                            <div class="col-md-4 text-center mb-3">
                                <div class="wrapp">
                                    <a href="{{ Storage::disk('uploads')->url($images->filename) }}" target="_blank">
                                        <img src="{{ Storage::disk('uploads')->url($images->filename) }}"
                                            style="max-height: 150px;">
                                        <form action="{{ route('deleteproductimage', $images->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" data-id="{{ $images->id }}" class="remove"
                                                title="Remove">x</button>
                                        </form>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('addmoreproductimages', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6 mt-5">
                                    <div class="form-group">
                                        <label for="photos">Add more images (Multiple images can be
                                            selected):</label>
                                        <input type="file" class="form-control" name="photos[]" multiple>
                                        @error('photos')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-primary form-control">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script>
        $('#details').summernote({
            height: 200,

        });

    </script>
@endpush
