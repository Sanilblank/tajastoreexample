@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('frontend/StarRating/min/jquery.rateyo.min.css')}}"/>
@endpush
@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$product->title}}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index')}}">Home</a>
                            <a href="{{route('shop')}}">{{$product->subcategory->title}}</a>
                            <span>{{$product->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    {{-- Calculations for Review --}}
    @php
        $reviews = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->orderBy('rating', 'DESC')->get();

        $noofreviews = count($reviews);
        $avgRatingFloat = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->avg('rating');
        $avgRating = number_format((float)$avgRatingFloat, 1, '.', '');
        $noof5stars = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->where('rating', 5)->count('rating');
        $noof4stars = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->where('rating', 4)->count('rating');
        $noof3stars = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->where('rating', 3)->count('rating');
        $noof2stars = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->where('rating', 2)->count('rating');
        $noof1stars = DB::table('reviews')->where('product_id', $product->id)->where('disable', null)->where('rating', 1)->count('rating');
        if ($noofreviews == 0) {
            $per5stars = 0;
            $per4stars = 0;
            $per3stars = 0;
            $per2stars = 0;
            $per1stars = 0;
        }
        else {
            $percent5stars = ($noof5stars/$noofreviews) * 100 ;
            $percent4stars = ($noof4stars/$noofreviews) * 100 ;
            $percent3stars = ($noof3stars/$noofreviews) * 100 ;
            $percent2stars = ($noof2stars/$noofreviews) * 100 ;
            $percent1stars = ($noof1stars/$noofreviews) * 100 ;
            $per5stars = number_format((float)$percent5stars, 1, '.', '');
            $per4stars = number_format((float)$percent4stars, 1, '.', '');
            $per3stars = number_format((float)$percent3stars, 1, '.', '');
            $per2stars = number_format((float)$percent2stars, 1, '.', '');
            $per1stars = number_format((float)$percent1stars, 1, '.', '');
        }

    @endphp

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-7">
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            <div class="product__details__pic">
                                <div class="product__details__pic__item">
                                    <img class="product__details__pic__item--large"
                                        src="{{ Storage::disk('uploads')->url($productimage->filename) }}" alt="{{$product->title}}">
                                </div>
                                <div class="product__details__pic__slider owl-carousel">
                                    @foreach ($productimages as $image)
                                        <img data-imgbigurl="{{ Storage::disk('uploads')->url($image->filename) }}"
                                            src="{{ Storage::disk('uploads')->url($image->filename) }}" alt="{{$product->title}}">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class=" col-lg-7 col-md-9 ml-4">
                            <div class="product__details__text">
                                <h3>{{$product->title}} ({{$product->quantity}} {{$product->unit}})</h3>
                                <div class="product__details__rating">
                                    <div class="row">
                                        <div class="rateyos-readonly-widg"></div>
                                        {{-- <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i> --}}
                                        <span>({{$noofreviews}} reviews)</span>
                                    </div>
                                </div>
                                @if ($product->discount > 0)
                                    @php
                                        $discountamount = ($product->discount / 100) * $product->price;
                                        $afterdiscount = $product->price - $discountamount;
                                    @endphp
                                    <div class="product__details__price">Rs. {{$afterdiscount}} <span style="color: black; font-size: 18px;"><strike>Rs. {{$product->price}}</strike><span></div>
                                @else
                                    <div class="product__details__price">Rs. {{$product->price}}</div>
                                @endif
                                @if (Auth::guest() || Auth::user()->role_id != 3)
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" onclick="openLoginModal();" class="primary-btn">ADD TO CART</a>
                                    <a href="javascript:void(0)" onclick="openLoginModal();" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                @elseif(Auth::user()->role_id==3)
                                    <form action="{{route('addtocart', $product->id)}}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="product__details__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="1" name="quantity" min="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" value="{{$product->price}}" name="price" class="form-control">
                                        </div>
                                        <a href="#" class="primary-btn" onclick="this.parentNode.submit()">ADD TO CART</a>
                                        <a href="{{route('addtowishlist', $product->id)}}" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                    </form>
                                @endif
                                <ul>
                                    @if ($product->unit_info > 0)
                                        <li><b>Availability</b> <span class="text-danger">In stock.</span> ({{$product->unit_info}} units available)</li>
                                    @else
                                        <li><b>Availability</b> <span class="text-danger">Out of stock.</span></li>
                                    @endif
                                    <li><b>Shipping</b> <span>01 day shipping. <samp> Free pickup today</samp></span></li>
                                    {{-- <li><b>Weight</b> <span>{{$product->quantity}} {{$product->unit}}</span></li> --}}
                                    <li><b>Vendor</b> <span>{{$product->vendor->name}}</span></li>
                                    {{-- <li><b>Share on</b>
                                        <div class="share">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                            aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                            aria-selected="false">Reviews <span>({{$noofreviews}})</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>Products Description</h6>
                                            <p>{!! $product->details !!}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>User Reviews</h6>

                                            <div class="mod-rating">
                                                <div class="content">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <p style="font-size: 50px"><b>{{$avgRating}}</b><span style="font-size: 30px">/5</span></p>
                                                            <div class="rateyo-readonly-widg"></div>
                                                            <p>{{$noofreviews}} ratings</p>

                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    @for ($i = 5; $i > 0; $i--)
                                                                        <i class="fa fa-star" style="font-size: 15px; color: orange;"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="progress" style="width: 300px; height: 15px; margin-top: 5px;">
                                                                        <div class="progress-bar bg-warning" style="width:{{$per5stars}}%"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    {{$noof5stars}}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    @for ($i = 4; $i > 0; $i--)
                                                                        <i class="fa fa-star" style="font-size: 15px; color: orange;"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="progress" style="width: 300px; height: 15px; margin-top: 5px;">
                                                                        <div class="progress-bar bg-warning" style="width:{{$per4stars}}%"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    {{$noof4stars}}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    @for ($i = 3; $i > 0; $i--)
                                                                        <i class="fa fa-star" style="font-size: 15px; color: orange;"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="progress" style="width: 300px; height: 15px; margin-top: 5px;">
                                                                        <div class="progress-bar bg-warning" style="width:{{$per3stars}}%"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    {{$noof3stars}}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    @for ($i = 2; $i > 0; $i--)
                                                                        <i class="fa fa-star" style="font-size: 15px; color: orange;"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="progress" style="width: 300px; height: 15px; margin-top: 5px;">
                                                                        <div class="progress-bar bg-warning" style="width:{{$per2stars}}%"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    {{$noof2stars}}
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    @for ($i = 1; $i > 0; $i--)
                                                                        <i class="fa fa-star" style="font-size: 15px; color: orange;"></i>
                                                                    @endfor
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <div class="progress" style="width: 300px; height: 15px; margin-top: 5px;">
                                                                        <div class="progress-bar bg-warning" style="width:{{$per1stars}}%"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    {{$noof1stars}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="customer-review-option mt-1">
                                                @if (Auth::guest())
                                                    <a href="javascript:void(0)" onclick="openLoginModal();" class="btn btn-primary" style="background-color: #f39c12; border: none;">Login to leave or modify Review</a>
                                                    <br><hr>
                                                @else
                                                    @php
                                                        $userreview = DB::table('reviews')->where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                                                    @endphp
                                                    @if ($userreview)
                                                        <hr>
                                                        <h5 style="color: #b83955; margin-bottom:1rem;">Your Review
                                                            {{-- <a href="#" class="btn btn-success btn-sm ml-4">&nbsp; Edit &nbsp;</a> --}}
                                                            <button type="button" class="btn btn-success btn-sm ml-4" data-toggle="modal" data-target="#editreviewModal{{$product->id . Auth::user()->id}}">&nbsp; Edit &nbsp;</button>
                                                            <!-- Modal -->
                                                            <div class="modal fade" id="editreviewModal{{$product->id . Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="editreviewModalLabel">Update your Review</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <form action="{{route('updatereview', $userreview->id)}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <div class="container d-flex justify-content-center">
                                                                                        <div class="row">
                                                                                            <div class="col-md-2">
                                                                                            </div>
                                                                                            <div class="col-md-9">
                                                                                                <div class="stars">
                                                                                                    <input class="star star-5" id="starrating-5{{$product->id . Auth::user()->id}}" type="radio" name="star" value="5"

                                                                                                    @if ($userreview->rating == 5)
                                                                                                        checked
                                                                                                    @endif />
                                                                                                    <label class="star star-5" for="starrating-5{{$product->id . Auth::user()->id}}"></label>
                                                                                                    <input class="star star-4" id="starrating-4{{$product->id . Auth::user()->id}}" type="radio" name="star" value="4"

                                                                                                    @if ($userreview->rating == 4)
                                                                                                        checked
                                                                                                    @endif />
                                                                                                    <label class="star star-4" for="starrating-4{{$product->id . Auth::user()->id}}"></label>
                                                                                                    <input class="star star-3" id="starrating-3{{$product->id . Auth::user()->id}}" type="radio" name="star" value="3"

                                                                                                    @if ($userreview->rating == 3)
                                                                                                        checked
                                                                                                    @endif />
                                                                                                    <label class="star star-3" for="starrating-3{{$product->id . Auth::user()->id}}"></label>
                                                                                                    <input class="star star-2" id="starrating-2{{$product->id . Auth::user()->id}}" type="radio" name="star" value="2"

                                                                                                    @if ($userreview->rating == 2)
                                                                                                        checked
                                                                                                    @endif />
                                                                                                    <label class="star star-2" for="starrating-2{{$product->id . Auth::user()->id}}"></label>
                                                                                                    <input class="star star-1" id="starrating-1{{$product->id . Auth::user()->id}}" type="radio" name="star" value="1"

                                                                                                    @if ($userreview->rating == 1)
                                                                                                        checked
                                                                                                    @endif />
                                                                                                    <label class="star star-1" for="starrating-1{{$product->id . Auth::user()->id}}"></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <textarea rows="4" cols="40" class="form-control" placeholder="Describe your experience (optional)" name="ratingdescription">{{$userreview->description}}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            <!-- Modal Ends -->

                                                            <form action="{{route('deleteuserreview', $userreview->id)}}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                            </form>
                                                            </h5>


                                                        <div class="co-item">
                                                            <div class="avatar-text">
                                                                    <h5 style="color: #3B5998">{{$userreview->username}} - <span style="font-size: 15px">{{ \Carbon\Carbon::parse($userreview->updated_at)->diffForHumans() }}</span></h5>
                                                                    <div class="at-rating mb-2">
                                                                        @for ($i = $userreview->rating; $i > 0; $i--)
                                                                            <i class="fa fa-star" style="color: #ffc107"></i>
                                                                        @endfor
                                                                        @for ($i =5 - $userreview->rating; $i > 0; $i--)
                                                                            <i class="fa fa-star-o" style="color: grey"></i>
                                                                        @endfor
                                                                    </div>
                                                                    <div class="at-reply">{{$userreview->description}}</div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h5 style="color: #b83955">All Reviews</h5>
                                                        <br>
                                                    @else
                                                        {{-- <a href="#" class="btn btn-primary" style="background-color: #f39c12; border: none;">Leave a Review</a> --}}
                                                        <button type="button" class="btn btn-primary" style="background-color: #f39c12; border: none;" data-toggle="modal" data-target="#reviewModal{{$product->id . Auth::user()->id}}">Leave a Review</button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="reviewModal{{$product->id . Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <form action="{{route('addreview')}}" method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <div class="container d-flex justify-content-center">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <div class="stars">
                                                                                                <input class="star star-5" id="star-5{{$product->id . Auth::user()->id}}" type="radio" name="star" value="5"/>
                                                                                                <label class="star star-5" for="star-5{{$product->id . Auth::user()->id}}"></label>
                                                                                                <input class="star star-4" id="star-4{{$product->id . Auth::user()->id}}" type="radio" name="star" value="4"/>
                                                                                                <label class="star star-4" for="star-4{{$product->id . Auth::user()->id}}"></label>
                                                                                                <input class="star star-3" id="star-3{{$product->id . Auth::user()->id}}" type="radio" name="star" value="3"/>
                                                                                                <label class="star star-3" for="star-3{{$product->id . Auth::user()->id}}"></label>
                                                                                                <input class="star star-2" id="star-2{{$product->id . Auth::user()->id}}" type="radio" name="star" value="2"/>
                                                                                                <label class="star star-2" for="star-2{{$product->id . Auth::user()->id}}"></label>
                                                                                                <input class="star star-1" id="star-1{{$product->id . Auth::user()->id}}" type="radio" name="star" value="1"/>
                                                                                                <label class="star star-1" for="star-1{{$product->id . Auth::user()->id}}"></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <input type="hidden" name="username" value="{{Auth::user()->name}}">
                                                                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                                                                            <textarea rows="4" cols="40" class="form-control" placeholder="Describe your experience (optional)" name="ratingdescription"></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Ends -->
                                                        <br><hr>
                                                    @endif

                                                @endif
                                                @if ($noofreviews == 0)
                                                    <p style="color: gray">No reviews for this product</p>

                                                @else
                                                    @if (count($reviews) == 0)
                                                            <p style="color: gray">No reviews given by others for this product</p>
                                                    @else
                                                        @foreach ($reviews as $review)
                                                                <div class="co-item">
                                                                    <div class="avatar-text">
                                                                            <h5 style="color: #3B5998">{{$review->username}} - <span style="font-size: 15px">{{ \Carbon\Carbon::parse($review->updated_at)->diffForHumans() }}</span></h5>
                                                                            <div class="at-rating mb-2">
                                                                                @for ($i = $review->rating; $i > 0; $i--)
                                                                                    <i class="fa fa-star" style="color: #ffc107"></i>
                                                                                @endfor
                                                                                @for ($i =5 - $review->rating; $i > 0; $i--)
                                                                                    <i class="fa fa-star-o" style="color: grey"></i>
                                                                                @endfor
                                                                            </div>
                                                                            <div class="at-reply">{{$review->description}}</div>
                                                                    </div>
                                                                </div>
                                                                <hr>

                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-5 mt-1">
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
                                        <a href="{{route('subcategory', $item->slug)}}" style="color: black;"> {{$item->title}}</a>
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
                                        @foreach ($filterproducts as $filterproduct)
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
                                            <a href="{{route('products', ['slug' => $filterproduct->slug, 'id'=>$filterproduct->id])}}" class="latest-product__item " style="display: {{$show}}">
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
                                                        <span>Rs. {{$afterdiscount}}</span>
                                                        <strike style="font-size: 15px; color: black;">Rs. {{$filterproduct->price}}</strike>
                                                    @else
                                                        <span>Rs. {{$filterproduct->price}}</span>
                                                    @endif
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                            @php
                                                $i=1;
                                            @endphp
                                        @foreach ($filterproducts as $filterproduct)
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
                                            <a href="{{route('products', ['slug' => $filterproduct->slug, 'id'=>$filterproduct->id])}}" class="latest-product__item" style="display: {{$show}}">
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
                                                        <span>Rs. {{$afterdiscount}}</span>
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
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedproducts as $relatedproduct)
                    @if ($relatedproduct->discount > 0)
                            <div class="product-lg-6 product-container" >
                                <div class="product__discount">
                                    @php
                                        $image = DB::table('product_images')
                                            ->where('product_id', $relatedproduct->id)
                                            ->first();
                                        $discountamount = ($relatedproduct->discount / 100) * $relatedproduct->price;
                                        $afterdiscount = $relatedproduct->price - $discountamount;
                                    @endphp
                                    <div onclick="location.href='{{route('products', ['slug' => $relatedproduct->slug, 'id'=>$relatedproduct->id])}}';" style="cursor: pointer;" class="product__discount__item__pic set-bg"
                                        data-setbg="{{ Storage::disk('uploads')->url($image->filename) }}">
                                        <div class="product__discount__percent">-{{ $relatedproduct->discount }}%</div>
                                        <ul class="product__item__pic__hover">
                                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                            @elseif(Auth::user()->role_id==3)
                                                <li><a href="{{ route('addtowishlist', $relatedproduct->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                                <li><a href="{{ route('products', ['slug' => $relatedproduct->slug, 'id'=>$relatedproduct->id]) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="{{ route('products', ['slug' => $relatedproduct->slug, 'id'=>$relatedproduct->id]) }}">{{ $relatedproduct->title }}</a></h5>
                                        <h6>({{$relatedproduct->quantity}} {{$relatedproduct->unit}})</h6>
                                        <div class="product__item__price">Rs. {{ $afterdiscount }} <span>Rs.
                                                {{ $relatedproduct->price }}</span></div>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="product-lg-6 col-md-6 col-sm-6 product-container">
                            <div class="product__item">
                            @php
                                $image = DB::table('product_images')
                                    ->where('product_id', $relatedproduct->id)
                                    ->first();
                            @endphp
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ Storage::disk('uploads')->url($image->filename)}}">
                                    <ul class="product__item__pic__hover">
                                        @if (Auth::guest() || Auth::user()->role_id != 3)
                                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>

                                        @elseif(Auth::user()->role_id==3)
                                            <li><a href="{{ route('addtowishlist', $relatedproduct->id)}}"><i class="fa fa-heart" title="Add To Wishlist"></i></a></li>
                                            <li><a href="{{ route('products', ['slug' => $relatedproduct->slug, 'id'=>$relatedproduct->id]) }}"><i class="fa fa-shopping-cart" title="Add To Cart"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h5><a href="{{route('products', ['slug' => $relatedproduct->slug, 'id'=>$relatedproduct->id])}}">{{$relatedproduct->title}}</a></h5>

                                    <h6>({{$relatedproduct->quantity}} {{$relatedproduct->unit}})</h6>
                                    <div class="product__item__price"><span>Rs. {{$relatedproduct->price}}</span></div>
                                </div>
                            </div>
                        </div>
                        @endif
                @endforeach
                {{-- <div class="col-lg-3 col-md-4 col-sm-6 ">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('frontend/img/product/product-2.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('frontend/img/product/product-3.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{ asset('frontend/img/product/product-7.jpg') }}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('frontend/StarRating/src/jquery.rateyo.js')}}"></script>

<script>

  $(function () {

    var rating = {{$avgRating}};

    $(".rateyos-readonly-widg").rateYo({

      rating: rating,
      numStars: 5,
      precision: 2,
      starWidth: "20px",
      minValue: 1,
      maxValue: 5
    }).on("rateyo.change", function (e, data) {
      console.log(data.rating);
    });

    $(".rateyo-readonly-widg").rateYo({

        rating: rating,
        numStars: 5,
        precision: 2,
        starWidth: "32px",
        minValue: 1,
        maxValue: 5
        }).on("rateyo.change", function (e, data) {
        console.log(data.rating);
        });
  });
</script>
@endpush
