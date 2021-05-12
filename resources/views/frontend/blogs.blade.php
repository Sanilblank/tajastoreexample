@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Tajamandi Blogs</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Blogs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7 mb-5">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title product__discount__title text-center">
                                    <h2>All Blogs</h2>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        @if (count($allblogs) == 0)
                            <p>No blogs at current time.</p>
                        @endif

                        @foreach ($allblogs as $blog)

                            <div class="col-lg-4 col-md-6 col-sm-6 product-container">
                                <div class="product__item">

                                    <div onclick="location.href='{{route('viewblog', $blog->id)}}';" style="cursor: pointer;" class="product__item__pic set-bg"
                                        data-setbg="{{ Storage::disk('uploads')->url($blog->image)}}">
                                        {{-- <ul class="product__item__pic__hover">
                                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                            @elseif(Auth::user()->role_id==3)
                                                <li><a href="{{ route('addtowishlist', $product->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                <li><a href="{{ route('products', ['slug' => $product->slug, 'id' => $product->id]) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                            @endif
                                        </ul> --}}
                                    </div>
                                    <div class="product__item__text" style="text-align: left; padding: 20px 10px;">
                                        @php
                                            $categories = $blog->category;
                                            $category = '';
                                            foreach ($categories as $cat) {
                                                $categoryname = DB::table('blog_categories')->where('id', $cat)->first();
                                                $category .= $categoryname->name. ',';
                                            }
                                        @endphp
                                        <b style="color: rgba(0, 0, 0, 0.3)">{{$category}}</b>
                                        <h5><a href="{{route('viewblog', $blog->id)}}">{{$blog->title}}</a></h5>
                                        {{-- <div class="product__item__price">{{$blog->title}}</div> --}}
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                    <div class="text-center">
                        {{ $allblogs->links() }}
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
                            <h4>Latest Categories</h4>
                            @php
                                $i = 1;
                            @endphp
                            @if (count($blogcategories) == 0)
                                No Categories
                            @endif
                            @foreach ($blogcategories as $item)
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
                                        <a href="{{route('categoryblogs', $item->slug)}}" style="color: black;"> {{$item->name}}</a>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Blogs</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                                $no = 1;
                                            @endphp

                                        @foreach ($filterblogs as $blog)
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
                                            <a href="{{route('viewblog', $blog->id)}}" class="latest-product__item " style="display: {{$show}}">
                                                <div class="latest-product__item__pic" style="margin-top: 20px;">

                                                    {{-- <img src="{{ Storage::disk('uploads')->url($blog->image) }}" alt="{{$blog->title}}" style="max-width: 110px; max-height: 110px;"> --}}
                                                    <span style="background: black; color:white; font-size: 25px; padding-left: 12px; padding-right: 15px;">{{$no++}}</span>
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$blog->title}}</h6>

                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                                $no = 4;
                                            @endphp
                                        @foreach ($filterblogs as $blog)
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
                                            <a href="{{route('viewblog', $blog->id)}}" class="latest-product__item" style="display: {{$show}}">
                                                <div class="latest-product__item__pic" style="margin-top: 20px;">

                                                    {{-- <img src="{{ Storage::disk('uploads')->url($blog->image) }}" alt="{{$blog->title}}" style="max-width: 110px; max-height: 110px;"> --}}
                                                    <span style="background: black; color:white; font-size: 25px; padding-left: 12px; padding-right: 15px;">{{$no++}}</span>
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$blog->title}}</h6>

                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Popular Blogs</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                                $no = 1;
                                            @endphp
                                        @foreach ($topblogs as $blog)
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
                                            <a href="{{route('viewblog', $blog->id)}}" class="latest-product__item " style="display: {{$show}}">
                                                <div class="latest-product__item__pic" style="margin-top: 20px;">

                                                    {{-- <img src="{{ Storage::disk('uploads')->url($blog->image) }}" alt="{{$blog->title}}" style="max-width: 110px; max-height: 110px;"> --}}
                                                    <span style="background: black; color:white; font-size: 25px; padding-left: 12px; padding-right: 15px;">{{$no++}}</span>
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$blog->title}}</h6>

                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                                $no = 4;
                                            @endphp
                                        @foreach ($topblogs as $blog)
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
                                            <a href="{{route('viewblog', $blog->id)}}" class="latest-product__item" style="display: {{$show}}">
                                                <div class="latest-product__item__pic" style="margin-top: 20px;">

                                                    {{-- <img src="{{ Storage::disk('uploads')->url($blog->image) }}" alt="{{$blog->title}}" style="max-width: 110px; max-height: 110px;"> --}}
                                                    <span style="background: black; color:white; font-size: 25px; padding-left: 12px; padding-right: 15px;">{{$no++}}</span>
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{$blog->title}}</h6>

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
