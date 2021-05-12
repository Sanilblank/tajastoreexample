@extends('frontend.layouts.app')

@section('content')

    @if (session('error'))
        <div class="row">
            <div class="col-sm-4 ml-auto message scroll">
                <div class="alert  alert-success alert-dismissible fade show" role="alert" style="background: darkred; color: white;">
                {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

<section id="home-section" class="hero">
    <div class="hero-wrap hero-bread" style="margin-top: -10rem; padding: 12em 0 0 0; text-align:center">
        {{-- <div class="pre-content-html" style="height:450px;max-width:1200px;position:relative" data-spm-anchor-id="a2a0e.12811.0.i1.1db73255HWff1t"> --}}
            <img src="{{Storage::disk('uploads')->url($currentblog->image)}}" style="width: 90%; object-fit: cover; max-height: 500px;" alt="Blog Photo">
        {{-- </div> --}}
    </div>
</section>
    <section class="ftco-section">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-9 col-md-7 mb-5">
    				<div class="row">
    				    <div class="col-md-12">
    				        @php
                                $categories = $currentblog->category;

                                foreach ($categories as $cat) {
                                    $categoryname = DB::table('blog_categories')->where('id', $cat)->first();
                                    $route = route('categoryblogs', $categoryname->slug);
                                    echo "<a href='$route' style='color:black'>|$categoryname->name|</a>";
                                }
                            @endphp
    				    </div>
		    		</div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title product__discount__title">
                                <h2>{{$currentblog->title}}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{Storage::disk('uploads')->url($currentblog->authorimage)}}" height="55px" width="55px">
                        </div>
                        <div class="col-md-4">
                            <p>{{$currentblog->authorname}}<br>
                            Posted on: {{date('F j, Y h:i a', strtotime($currentblog->date))}}</p>
                        </div>

                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            {!! $currentblog->details !!}
                        </div>
                    </div>

		    	</div>

                <div class="col-lg-3 col-md-5 mb-5">
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
@endsection
