@extends('backend.layouts.app')
@push('styles')


    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" /> --}}
     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" /> --}}
    {{-- <style type="text/css">
        .bootstrap-tagsinput{
            width: 100%;
        }
        .label-info{
            background-color: #17a2b8;

        }
        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,
            border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
    </style> --}}

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
        <h1 class="mt-3">Create Products <a href="{{route('order.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-eye" aria-hidden="true"></i> View All Orders</a></h1>
        <div class="card mt-3">

            <form action="{{route('productorder')}}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">First Name: </label>
                            <input type="text" name="firstname" class="form-control" value="{{ @old('firstname') }}"
                                placeholder="Enter Firstname of Customer">
                            @error('firstname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Address: </label>
                            <input type="text" name="address" class="form-control" value="{{ @old('address') }}"
                                placeholder="Enter address of Customer">
                            @error('address')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="district">District: </label>
                            <input type="text" name="district" class="form-control" value="{{ @old('district') }}"
                                placeholder="Enter district of Customer">
                            @error('district')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone: </label>
                            <input type="text" name="phone" class="form-control" value="{{ @old('phone') }}"
                                placeholder="Enter phone no of Customer">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last Name: </label>
                            <input type="text" name="lastname" class="form-control" value="{{ @old('lastname') }}"
                                placeholder="Enter Lastname of Customer">
                            @error('lastname')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="town">Town: </label>
                            <input type="text" name="town" class="form-control" value="{{ @old('town') }}"
                                placeholder="Enter town of Customer">
                            @error('town')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="postcode">Post Code: </label>
                            <input type="text" name="postcode" class="form-control" value="{{ @old('postcode') }}"
                                placeholder="Enter postcode of Customer">
                            @error('postcode')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="text" name="email" class="form-control" value="{{ @old('email') }}"
                                placeholder="Enter email of Customer">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_id">Products(Quantity will be 1):</label>
                            <select class="form-control chosen-select" data-placeholder="Choose Products ..." multiple name="product_id[]">

                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->title}} ({{$product->quantity}}{{$product->unit}})</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!--<div class="form-group">-->

                        <!--    <div class="form-group">-->
                        <!--        <label for="unit_info">Quantity of Products(5,6) :</label><br>-->

                        <!--        <input type="text" data-role="tagsinput" name="unit_info" class="form-control">-->

                        <!--        @error('unit_info')-->
                        <!--            <p class="text-danger">{{$message}}</p>-->
                        <!--        @enderror-->
                        <!--    </div>-->
                        <!--</div>-->
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

<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        $(".chosen-select").chosen({
            no_results_text: "Oops, nothing found!"
        });
    </script>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" integrity="sha512-KT0oYlhnDf0XQfjuCS/QIw4sjTHdkefv8rOJY5HHdNEZ6AmOh1DW/ZdSqpipe+2AEXym5D0khNu95Mtmw9VNKg==" crossorigin="anonymous"></script> --}}

@endpush
