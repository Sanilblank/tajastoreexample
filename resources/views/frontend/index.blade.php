@extends('frontend.layouts.app')

@section('content')

    <!-- Banner Section -->
    {{-- <div class="hero__item set-bg my-5" style="background-size:cover;" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}" >
        <div class="hero__text">
                   <span>FRESH FRUIT AND VEGETABLE</span>
            <h2>All Your Grocery Items </h2>
            <p>Free Pickup and Delivery Available</p>
            <a href="{{ route('shop') }}" class="primary-btn">SHOP NOW</a>
        </div>
    </div> --}}

    <!-- Modal autoclick button -->
    <a href="" data-toggle="modal" data-target="#contact_modal" id="contact">
    </a>

     <!-- modal -->
    <div class="modal fade" id="contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                 <img src="{{ asset('frontend/img/modaltaja.jpg') }}">
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-success" href="{{ route('subcategories', 'combo') }}" target="_blank">Order Now</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <section class="hero-section">
    <div class="hero-items owl-carousel">
        @foreach ($slider as $slideritem)
            <div onclick="location.href=" style="cursor: pointer; background-repeat: no-repeat; background-size:cover;background-position:top center;" class="single-hero-items set-bg" data-setbg="{{Storage::disk('uploads')->url($slideritem->images)}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 text-sm-center">
                            <span>{{$slideritem->subtitle}}</span>
                            <h1>{{$slideritem->title}}</h1>
                            <p >
                                @php
                                    echo $slideritem->description;
                                @endphp
                            </p>
                            <a href="{{route('shop')}}" class="primary-btn">Shop Now</a>
                        </div>
                    </div>
                    {{-- <div class="off-card">
                        <h2>Sale <span>{{$slideritem->discount}}%</span></h2>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>
</section>
    <!-- Banner Section end -->

    <!-- Categories Section Begin -->
    <section class="categories pt-5">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                        <h2>Our Categories</h2>
                    </div>
                </div>
                <div class="categories__slider owl-carousel">
                    @foreach ($subcategories as $subcategory)
                        <div class="col-lg-3">
                            <div onclick="location.href='{{route('subcategories', $subcategory->slug)}}';" style="cursor: pointer;" class="categories__item set-bg"
                                data-setbg="{{ Storage::disk('uploads')->url($subcategory->image_name) }}">
                                <h5><a href="{{route('subcategories', $subcategory->slug)}}">{{ $subcategory->title }}</a></h5>
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->
    {{-- <div class="aa-input-container" id="aa-input-container"> --}}
        {{-- <input type="search" id="aa-search-input-algolia" class="aa-input-search" placeholder="Find the phone of your choice...." name="search"
            autocomplete="off" />
        <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
            <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
        </svg> --}}
    {{-- </div> --}}
    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($featuredproducts as $product)
                    @if ($product->discount > 0)
                                <div class="product-lg-6 col-md-4 col-sm-6 product-container">
                                    <div class="product__discount__item product__discount">
                                        @php
                                            $image = DB::table('product_images')
                                                ->where('product_id', $product->id)
                                                ->first();
                                            $discountamount = ($product->discount / 100) * $product->price;
                                            $afterdiscount = $product->price - $discountamount;
                                        @endphp
                                        <div onclick="location.href='{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}';" style="cursor: pointer;" class="product__discount__item__pic set-bg"
                                            data-setbg="{{ Storage::disk('uploads')->url($image->filename) }}">
                                            <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                            <ul class="product__item__pic__hover">

                                                @if (Auth::guest() || Auth::user()->role_id != 3)
                                                    <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                                @elseif(Auth::user()->role_id==3)
                                                    <li><a href="{{ route('addtowishlist', $product->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                                @endif

                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <b>({{$product->quantity}} {{$product->unit}})</b>
                                            <h5><a href="{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}">{{ $product->title }}</a></h5>
                                            <div class="product__item__price">Rs. {{ ceil($afterdiscount) }} <span>Rs.
                                                    {{ $product->price }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="product-lg-6 col-md-4 col-sm-6 product-container">
                                <div class="product__item">
                                @php
                                    $image = DB::table('product_images')
                                        ->where('product_id', $product->id)
                                        ->first();
                                @endphp
                                    <div onclick="location.href='{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}';" style="cursor: pointer;" class="product__item__pic set-bg"
                                        data-setbg="{{ Storage::disk('uploads')->url($image->filename)}}">
                                        <ul class="product__item__pic__hover">
                                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                            @elseif(Auth::user()->role_id==3)
                                                <li><a href="{{ route('addtowishlist', $product->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                <li><a href="{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <b>({{$product->quantity}} {{$product->unit}})</b>
                                        <h5><a href="{{route('products', ['slug' => $product->slug, 'id'=>$product->id])}}">{{$product->title}}</a></h5>
                                        <div class="product__item__price">Rs. {{$product->price}}</div>
                                    </div>
                                </div>
                            </div>
                            @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Discount Products -->

@if(count($offerproducts) == 0)

@else
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="product__discount" style="border:none; margin-bottom:40px;">
                        <div class="section-title product__discount__title text-center">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                                <div class="product__discount__slider owl-carousel">
                                @foreach ($offerproducts as $product)
                                    <div class="col-lg-4 product-container">
                                        <div class="product__discount__item">
                                            @php
                                                $image = DB::table('product_images')
                                                    ->where('product_id', $product->id)
                                                    ->first();
                                                $discountamount = ($product->discount / 100) * $product->price;
                                                $afterdiscount = $product->price - $discountamount;
                                            @endphp
                                            <div onclick="location.href='{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}';" style="cursor: pointer;" class="product__discount__item__pic set-bg"
                                                data-setbg="{{ Storage::disk('uploads')->url($image->filename) }}">
                                                <div class="product__discount__percent">-{{ $product->discount }}%</div>
                                                <ul class="product__item__pic__hover">
                                                    @if (Auth::guest() || Auth::user()->role_id != 3)
                                                    <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                                @elseif(Auth::user()->role_id==3)
                                                    <li><a href="{{ route('addtowishlist', $product->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                    <li><a href="{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                                @endif
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>{{ $product->subcategory->title }}</span>
                                                <h5 style="font-size: 20px; font-weight: 650"><a href="{{ route('products', ['slug' => $product->slug, 'id'=>$product->id]) }}">{{ $product->title }} </a></h5>
                                                <h6>({{$product->quantity}} {{$product->unit}})</h6>
                                                <div class="product__item__price">Rs. {{ ceil($afterdiscount) }} <span>Rs.
                                                        {{ $product->price }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endif
    <!-- discount end -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad" style="padding-top: 20px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="latest-product__text">
                {{-- <h4>Latest Products</h4> --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Latest Products</h2>
                        </div>
                    </div>
                </div>
                <div class="latest-product__slider owl-carousel">
                  <div class="row latest-prdouct__slider__item">
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($filterproducts as $filterproduct)
                        @php
                            if($i < 5)
                            {
                                $show = 'block';
                                $i = $i+1;
                            }
                            else {
                                $show = 'none';
                                $i = $i+1;
                            }
                        @endphp
                        <a href="{{route('products', ['slug' => $filterproduct->slug, 'id'=>$filterproduct->id])}}" class="latest-product__item col-lg-3 col-sm-6 " style="display: {{$show}}">
                            <div class="latest-product__item__pic">
                                @php
                                $image = DB::table('product_images')
                                    ->where('product_id', $filterproduct->id)
                                    ->first()
                                @endphp
                            <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$filterproduct->title}}" style="max-width: 110px; max-height: 110px;">
                            </div>
                            <div class="latest-product__item__text">
                            <h6>{{$filterproduct->title}} ({{$filterproduct->quantity}} {{$filterproduct->unit}})</h6>
                            @if ($filterproduct->discount > 0)
                                @php
                                    $discountamount = ($filterproduct->discount / 100) * $filterproduct->price;
                                    $afterdiscount = $filterproduct->price - $discountamount;
                                @endphp
                                <span>Rs. {{ceil($afterdiscount)}}</span>
                                <strike style="font-size: 15px; color: black;">Rs. {{$filterproduct->price}}</strike>
                            @else
                                <span>Rs. {{$filterproduct->price}}</span>
                            @endif
                            </div>
                        </a>
                      @endforeach
                  </div>

                  <div class="row latest-prdouct__slider__item">
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($filterproducts as $filterproduct)
                      @php
                          if($i < 5)
                          {
                              $show = 'none';
                              $i = $i+1;
                          }
                          else {
                              $show = 'block';
                              $i = $i+1;
                          }
                      @endphp
                      <a href="{{route('products', ['slug' => $filterproduct->slug, 'id'=>$filterproduct->id])}}" class="latest-product__item col-lg-3 col-sm-6" style="display: {{$show}}">
                          <div class="latest-product__item__pic">
                              @php
                              $image = DB::table('product_images')
                                  ->where('product_id', $filterproduct->id)
                                  ->first()
                              @endphp
                          <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$filterproduct->title}}" style="max-width: 110px; max-height: 110px;">
                          </div>
                          <div class="latest-product__item__text">
                          <h6>{{$filterproduct->title}} ({{$filterproduct->quantity}} {{$filterproduct->unit}})</h6>
                          @if ($filterproduct->discount > 0)
                            @php
                                $discountamount = ($filterproduct->discount / 100) * $filterproduct->price;
                                $afterdiscount = $filterproduct->price - $discountamount;
                            @endphp
                                <span>Rs. {{ceil($afterdiscount)}}</span>
                                <strike style="font-size: 15px; color: black;">Rs. {{$filterproduct->price}}</strike>
                            @else
                                <span>Rs. {{$filterproduct->price}}</span>
                            @endif
                          </div>
                      </a>
                    @endforeach
                </div>
                </div>
              </div>
            </div>

    <!-- Banner Begin -->
    <div class="banner mt-3 mb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="banner__pic" style="border: 1px solid black;">
                        <img src="{{ asset('frontend/img/banner/banner.jpg') }}" alt="">
                    </div>
                <!--</div>-->
                <!--<div class="col-lg-6 col-md-6 col-sm-6">-->
                <!--    <div class="banner__pic">-->
                <!--        <img src="{{ asset('frontend/img/banner/banner-2.jpg') }}" alt="">-->
                <!--    </div>-->
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

            <div class="col-lg-12 mb-3">
                <div class="latest-product__text">
                  {{-- <h4>Latest Products</h4> --}}
                  <div class="row mt-5">
                      <div class="col-lg-12">
                          <div class="section-title">
                              <h2>Top Rated Products</h2>
                          </div>
                      </div>
                  </div>
                  <div class="latest-product__slider owl-carousel">
                    <div class="row latest-prdouct__slider__item">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($ratedproducts as $ratedproduct)
                          @php
                              if($i < 5)
                              {
                                  $show = 'block';
                                  $i = $i+1;
                              }
                              else {
                                  $show = 'none';
                                  $i = $i+1;
                              }
                          @endphp
                          <a href="{{route('products', ['slug' => $ratedproduct->product->slug, 'id'=>$ratedproduct->product->id])}}" class="latest-product__item col-lg-3 col-sm-6" style="display: {{$show}}">
                              <div class="latest-product__item__pic">
                                  @php
                                  $image = DB::table('product_images')
                                      ->where('product_id', $ratedproduct->product_id)
                                      ->first()
                                  @endphp
                              <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$ratedproduct->product->title}}" style="max-width: 110px; max-height: 110px;">
                              </div>
                              <div class="latest-product__item__text">
                              <h6>{{$ratedproduct->product->title}} ({{$ratedproduct->product->quantity}} {{$ratedproduct->product->unit}})</h6>
                              @if ($ratedproduct->product->discount > 0)
                                @php
                                    $discountamount = ($ratedproduct->product->discount / 100) * $ratedproduct->product->price;
                                    $afterdiscount = $ratedproduct->product->price - $discountamount;
                                @endphp
                                    <span>Rs. {{ceil($afterdiscount)}}</span>
                                    <strike style="font-size: 15px; color: black;">Rs. {{$ratedproduct->product->price}}</strike>
                                @else
                                    <span>Rs. {{$ratedproduct->product->price}}</span>
                                @endif
                              </div>
                          </a>
                        @endforeach
                    </div>

                    <div class="row latest-prdouct__slider__item">
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($ratedproducts as $ratedproduct)
                        @php
                            if($i < 5)
                            {
                                $show = 'none';
                                $i = $i+1;
                            }
                            else {
                                $show = 'block';
                                $i = $i+1;
                            }
                        @endphp
                        <a href="{{route('products', ['slug' => $ratedproduct->product->slug, 'id'=>$ratedproduct->product->id])}}" class="latest-product__item col-lg-3 col-sm-6" style="display: {{$show}}">
                            <div class="latest-product__item__pic">
                                @php
                                $image = DB::table('product_images')
                                    ->where('product_id', $ratedproduct->product_id)
                                    ->first()
                                @endphp
                            <img src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$ratedproduct->product->title}}" style="max-width: 110px; max-height: 110px;">
                            </div>
                            <div class="latest-product__item__text">
                            <h6>{{$ratedproduct->product->title}} ({{$ratedproduct->product->quantity}} {{$ratedproduct->product->unit}})</h6>
                            @if ($ratedproduct->product->discount > 0)
                                @php
                                    $discountamount = ($ratedproduct->product->discount / 100) * $ratedproduct->product->price;
                                    $afterdiscount = $ratedproduct->product->price - $discountamount;
                                @endphp
                                    <span>Rs. {{ceil($afterdiscount)}}</span>
                                    <strike style="font-size: 15px; color: black;">Rs. {{$ratedproduct->product->price}}</strike>
                                @else
                                    <span>Rs. {{$ratedproduct->product->price}}</span>
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
      </section>
      <!-- Latest Product Section End -->
@endsection
@push('scripts')
<script>
    jQuery(function(){
       jQuery('#contact').click();
    });
</script>
@endpush
