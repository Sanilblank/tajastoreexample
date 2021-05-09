@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;"w data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Tajamandi Request Product</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Request Product</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    @php
        if(!Auth::guest())
        {
            $address = DB::table('delievery_addresses')->where('user_id', Auth::user()->id)->where('is_default', 1)->first();
        }
    @endphp

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7 mb-5">
                    <!-- Form Begin -->
                    <div class="contact-form spad" style="margin-top: -5rem;">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section-title product__discount__title text-center">
                                        <h2>Please fill the form below</h2>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('storeProductRequest')}}" method="POST">
                                @csrf
                                @method('POST')
                                @if (!Auth::guest())
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="name">Full Name:</label>
                                            <input type="text" placeholder="Your name" name="name" value="{{@old('name') ? @old('name') : (($address)?$address->firstname .' '. $address->lastname:'')}}">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="phone">Contact No:</label>
                                            <input type="text" placeholder="Contact Information" name="phone" value="{{@old('phone') ? @old('phone') : (($address)?$address->phone:'')}}">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="address">Address:</label>
                                            <input type="text" placeholder="Address Information" name="address" value="{{@old('address') ? @old('address') : (($address)?$address->address. ', ' . $address->town:'')}}">
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="email">Email:</label>
                                            <input type="text" placeholder="Enter Email Address" name="email" value="{{@old('email') ? @old('email') : (($address)?$address->email:'')}}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="product">Product Name:</label>
                                            <input type="text" placeholder=" Eg: Gas Cylinder" name="product" value="{{@old('product')}}">
                                            @error('product')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="description">Description of Product:</label>
                                            <textarea placeholder="Write Description of Product" name="description"></textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">

                                                    <p style="color: red">Note*: Your order might be picked up seperately from retail shop so, bill for request order will be seperate and can be high.<br><br>
                                                    Delivery charge will also be taken seperately. You will receive a call to confirm your requested order.</p>

                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="site-btn">Submit</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <label for="name">Full Name:</label>
                                            <input type="text" placeholder="Your name" name="name" value="{{@old('name')}}">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="phone">Contact No:</label>
                                            <input type="text" placeholder="Contact Information" name="phone" value="{{@old('phone')}}">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="address">Address:</label>
                                            <input type="text" placeholder="Address Information" name="address" value="{{@old('address')}}">
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="email">Email:</label>
                                            <input type="text" placeholder="Enter Email Address" name="email" value="{{@old('email')}}">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <label for="product">Product Name:</label>
                                            <input type="text" placeholder=" Eg: Gas Cylinder" name="product" value="{{@old('product')}}">
                                            @error('product')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="description">Description of Product:</label>
                                            <textarea placeholder="Write Description of Product" name="description"></textarea>
                                            @error('description')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12">

                                                    <p style="color: red">Note*: Your order might be picked up seperately from retail shop so, bill for request order will be seperate and can be high.<br><br>
                                                    Delivery charge will also be taken seperately. You will receive a call to confirm your requested order.</p>

                                        </div>
                                        <div class="col-lg-12">
                                            <button type="submit" class="site-btn">Submit</button>
                                        </div>
                                    </div>

                                @endif

                            </form>
                        </div>
                    </div>
                    <div class="text-center">

                    </div>
                    {{-- <div class="product__pagination text-center"> --}}

                        {{-- <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                    {{-- </div> --}}
                </div>
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        {{-- <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div> --}}
                        {{-- <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div> --}}
                        <div class="sidebar__item">
                            <h4>Our Categories</h4>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($subcategories as $item)
                                @php
                                    if($i > 10)
                                    {
                                        $show = 'none';
                                    }
                                    else
                                    {
                                        $show = '';
                                        $i = $i+1;
                                    }
                                @endphp
                                <div class="sidebar__item__size" style="display:{{$show}}">
                                    <label for="large">
                                        <a href="{{route('subcategories', $item->slug)}}" style="color: black;"> {{$item->title}}</a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                            @endphp
                                        @foreach ($filterproducts as $product)
                                        @php
                                            if($i < 4)
                                            {
                                                $show = 'block';
                                                $i = $i+1;
                                            }
                                            else {
                                                $show = 'none';
                                                $i = $i+1;
                                            }
                                        @endphp
                                            <a href="{{route('products', ['slug' => $product->slug, 'id'=>$product->id])}}" class="latest-product__item " style="display: {{$show}}">
                                                <div class="latest-product__item__pic">
                                                    @php
                                                        $image = DB::table('product_images')
                                                            ->where('product_id', $product->id)
                                                            ->first()
                                                    @endphp
                                                    <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$product->title}}" style="max-width: 110px; max-height: 110px;">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$product->title}} ({{$product->quantity}} {{$product->unit}})</h6>
                                                    @if ($product->discount > 0)
                                                    @php
                                                        $discountamount = ($product->discount / 100) * $product->price;
                                                        $afterdiscount = $product->price - $discountamount;
                                                    @endphp
                                                        <span>Rs. {{$afterdiscount}}</span>
                                                        <strike style="font-size: 15px; color: black;">Rs. {{$product->price}}</strike>
                                                    @else
                                                        <span>Rs. {{$product->price}}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                            @endphp
                                        @foreach ($filterproducts as $product)
                                        @php
                                            if($i < 4)
                                            {
                                                $show = 'none';
                                                $i = $i+1;
                                            }
                                            else {
                                                $show = 'block';
                                                $i = $i+1;
                                            }
                                        @endphp
                                            <a href="{{route('products', ['slug' => $product->slug, 'id'=>$product->id])}}" class="latest-product__item" style="display: {{$show}}">
                                                <div class="latest-product__item__pic">
                                                    @php
                                                        $image = DB::table('product_images')
                                                            ->where('product_id', $product->id)
                                                            ->first()
                                                    @endphp
                                                    <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$product->title}}" style="max-width: 110px; max-height: 110px;">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$product->title}} ({{$product->quantity}} {{$product->unit}})</h6>
                                                    @if ($product->discount > 0)
                                                    @php
                                                        $discountamount = ($product->discount / 100) * $product->price;
                                                        $afterdiscount = $product->price - $discountamount;
                                                    @endphp
                                                        <span>Rs. {{$afterdiscount}}</span>
                                                        <strike style="font-size: 15px; color: black;">Rs. {{$product->price}}</strike>
                                                    @else
                                                        <span>Rs. {{$product->price}}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Top Rated Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                            @endphp
                                        @foreach ($ratedproducts as $ratedproduct)
                                        @php
                                            $productis = DB::table('products')->where('id', $ratedproduct->product_id)->first();
                                        @endphp
                                        @php
                                            if($i < 4)
                                            {
                                                $show = 'block';
                                                $i = $i+1;
                                            }
                                            else {
                                                $show = 'none';
                                                $i = $i+1;
                                            }
                                        @endphp
                                            <a href="{{route('products', ['slug' => $productis->slug, 'id'=>$productis->id])}}" class="latest-product__item " style="display: {{$show}}">
                                                <div class="latest-product__item__pic">
                                                    @php
                                                        $image = DB::table('product_images')
                                                            ->where('product_id', $productis->id)
                                                            ->first()
                                                    @endphp
                                                    <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$productis->title}}" style="max-width: 110px; max-height: 110px;">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$productis->title}} ({{$productis->quantity}} {{$productis->unit}})</h6>
                                                    @if ($productis->discount > 0)
                                                    @php
                                                        $discountamount = ($productis->discount / 100) * $productis->price;
                                                        $afterdiscount = $productis->price - $discountamount;
                                                    @endphp
                                                        <span>Rs. {{$afterdiscount}}</span>
                                                        <strike style="font-size: 15px; color: black;">Rs. {{$productis->price}}</strike>
                                                    @else
                                                        <span>Rs. {{$productis->price}}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                            @endphp
                                        @foreach ($ratedproducts as $ratedproduct)
                                        @php
                                            $productis = DB::table('products')->where('id', $ratedproduct->product_id)->first();
                                        @endphp
                                        @php
                                            if($i < 4)
                                            {
                                                $show = 'none';
                                                $i = $i+1;
                                            }
                                            else {
                                                $show = 'block';
                                                $i = $i+1;
                                            }
                                        @endphp
                                            <a href="{{route('products', ['slug' => $productis->slug, 'id'=>$productis->id])}}" class="latest-product__item" style="display: {{$show}}">
                                                <div class="latest-product__item__pic">
                                                    @php
                                                        $image = DB::table('product_images')
                                                            ->where('product_id', $productis->id)
                                                            ->first()
                                                    @endphp
                                                    <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$productis->title}}" style="max-width: 110px; max-height: 110px;">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$productis->title}} ({{$productis->quantity}} {{$productis->unit}})</h6>
                                                    @if ($productis->discount > 0)
                                                    @php
                                                        $discountamount = ($productis->discount / 100) * $productis->price;
                                                        $afterdiscount = $productis->price - $discountamount;
                                                    @endphp
                                                        <span>Rs. {{$afterdiscount}}</span>
                                                        <strike style="font-size: 15px; color: black;">Rs. {{$productis->price}}</strike>
                                                    @else
                                                        <span>Rs. {{$productis->price}}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

