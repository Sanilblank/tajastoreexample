@extends('backend.singlevendor.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"
        integrity="sha256-n3YISYddrZmGqrUgvpa3xzwZwcvvyaZco0PdOyUKA18=" crossorigin="anonymous" />
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Create Products <a href="{{ route('singlevendorproduct.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View My Products</a></h1>
        <div class="card mt-3">

            <form action="{{ route('singlevendorproduct.store') }}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label for="vendor">Vendor</label>
                            <select name="vendor" class="form-control">
                                <option value="">--Select a Vendor--</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                            @error('vendor')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="subcategory">Product Subcategory</label>
                            <select name="subcategory" class="form-control">
                                <option value="">--Select a subcategory--</option>
                                @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                                @endforeach
                            </select>
                            @error('subcategory')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Product Title: </label>
                            <input type="text" name="title" class="form-control" value="{{ @old('title') }}"
                                placeholder="Enter Product Title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="boought_price">Bought Price (From Vendor): </label>
                            <input type="text" name="bought_price" class="form-control" value="{{ @old('bought_price') }}"
                                placeholder="Enter Bought Price">
                            @error('bought_price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Product Price (Selling Price): </label>
                            <input type="text" name="price" class="form-control" value="{{ @old('price') }}"
                                placeholder="Enter Selling Price">
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock (Quantity): </label>
                            <input type="text" name="stock" class="form-control" value="{{ @old('stock') }}"
                                placeholder="Enter number of quantity">
                            @error('stock')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="discount">Product Discount: </label>
                            <input type="text" name="discount" class="form-control" value="{{ @old('discount') }}"
                                placeholder="Enter Product Discount">
                            @error('discount')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="quantity">Product Quantity: </label>
                                    <input type="text" name="quantity" class="form-control" value="{{ @old('quantity') }}"
                                        placeholder="Enter Product Quantity">
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="unit">Product Unit: </label>
                                    <input type="text" name="unit" class="form-control" value="{{ @old('unit') }}"
                                        placeholder="Eg: Kg, Liter">
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
                            <input type="text" name="shipping" class="form-control" value="{{ @old('shipping') }}"
                                placeholder="Enter Product Shipping">
                            @error('shipping')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Select Multiple Images</label>
                            <input type="file" name="photos[]" id="uploads" class="form-control" multiple>
                            @error('photos')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea name="details" class="form-control" id="details" cols="30" rows="10"
                                placeholder="Enter Product Details"></textarea>

                            @error('details')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Status: </label>
                                    <input type="radio" name="status" value="1"> Approved
                                    <input type="radio" name="status" value="0"> Not Approved

                                    @error('status')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="featured">Featured: </label>
                                    <input type="radio" name="featured" value="1"> Yes
                                    <input type="radio" name="featured" value="0"> No

                                    @error('featured')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script>
        $('#details').summernote({
            height: 200,
        });

    </script>
@endpush
