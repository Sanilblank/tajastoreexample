@extends('frontend.layouts.app')

@section('content')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{asset('frontend/img/breadcrumb.jpg')}}">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcrumb__text">
              <h2>{{$cookbookitem->itemname}}</h2>
              <div class="breadcrumb__option">
                <span>{{$cookbookitem->subcategory->subcategory}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div class="container mt-3">
        <!-- ============= COMPONENT ============== -->
        <nav class="navbar navbar-expand-lg navbar-dark cbnav" >
          <div class="container-fluid">
            <a class="navbar-brand" href="{{route('cookbook')}}">TajaRecipe</a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#main_nav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">
              <ul class="navbar-nav">

                  @foreach ($navbaritems as $navbaritem)
                  <li class="nav-item dropdown has-megamenu cbdrop px-4">
                      <a
                        class="nav-link dropdown-toggle cblink"
                        href="#"
                        data-bs-toggle="dropdown"
                      >
                        {{$navbaritem->navbar_item}}
                      </a>
                      <div class="dropdown-menu megamenu" role="menu">
                        <div class="row g-3">
                          @php
                              $categories = DB::table('cookbook_categories')->where('cookbooknavbar_id', $navbaritem->id)->where('status', 1)->get();
                          @endphp
                          @foreach ($categories as $category)
                              <div class="col-lg-3 col-6">
                                  <div class="col-megamenu">
                                  <h6 class="title">{{$category->category}}</h6>
                                  <ul class="list-unstyled">
                                      @php
                                          $subcategories = DB::table('cookbook_subcategories')->where('cookbookcategory_id', $category->id)->where('status', 1)->get();
                                      @endphp
                                      @foreach ($subcategories as $subcategory)
                                          <li><a href="{{route('cookbooksubcategories', [$subcategory->id, $subcategory->slug])}}">{{$subcategory->subcategory}}</a></li>
                                      @endforeach
                                  </ul>
                                  </div>
                                  <!-- col-megamenu.// -->
                              </div>
                            <!-- end col-3 -->

                          @endforeach

                        </div>
                        <!-- end row -->
                      </div>
                      <!-- dropdown-mega-menu.// -->
                    </li>
                  @endforeach


              </ul>
            </div>
            <!-- navbar-collapse.// -->
          </div>
          <!-- container-fluid.// -->
        </nav>
        <!-- ============= COMPONENT END// ============== -->
        </div>

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6">
            <div class="product__details__pic">
              <div class="product__details__pic__item">
                <img
                  class="product__details__pic__item--large"
                  src="{{Storage::disk('uploads')->url($cookbookitem->itemimage)}}"
                  alt="Recipe Image"
                />
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="product__details__text">
              <h3>{{$cookbookitem->itemname}}</h3>
              {{-- <div class="product__details__rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
                <span>(18 reviews)</span>
              </div> --}}
              <div class="col-lg-12">
                <div class="blog__details__author">
                  <div class="blog__details__author__pic">
                    <img src="{{Storage::disk('uploads')->url($cookbookitem->recipebyimage)}}" alt="Image of Author" />
                  </div>
                  <div class="blog__details__author__text">
                    <h6>{{$cookbookitem->recipeby}}</h6>
                    {{-- <span>Chinese Chef</span> --}}
                  </div>
                </div>
              </div>

              <p class="py-3">
                {!! $cookbookitem->description !!}
              </p>

              <div class="col-lg-8 col-md-7 order-md-1 order-1 py-2">
                <div class="blog__details__content">
                  <div class="row">

                    <div class="col-lg-12">
                      <div class="blog__details__widget">
                          <div class="row py-3" style="border-top: 1px solid #ebebeb;">
                              <div class="col-lg-4 col-md-6">
                                  <p style="color: #7fad39; margin-bottom: 10px; font-size:18px">Course</p>
                                  <p>{{$cookbookitem->course}}</p>
                              </div>
                              <div class="col-lg-4 col-md-6">
                                <p style="color: #7fad39; margin-bottom: 10px; font-size:18px">Cuisine</p>
                                <p>{{$cookbookitem->cuisine}}</p>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <p style="color: #7fad39; margin-bottom: 10px; font-size:18px">Time of Day</p>
                                <p>{{$cookbookitem->timeofday}}</p>
                            </div>
                          </div>
                          <div class="row py-3">
                            <div class="col-lg-6 col-md-6">
                                <p style="color: #7fad39; margin-bottom: 10px; font-size:18px">Level of Cooking</p>
                                <p>{{$cookbookitem->levelofcooking->level}}</p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                              <p style="color: #7fad39; margin-bottom: 10px; font-size:18px">Recipe Type</p>
                              <p>{{$cookbookitem->recipetype->type}}</p>
                          </div>

                        </div>
                        {{-- <ul>
                          <li><span>Categories:</span> Food</li>
                          <li>
                            <span>Tags:</span> All, Trending, Cooking, Healthy
                            Food, Life Style
                          </li>
                        </ul> --}}
                        {{-- <div class="blog__details__social pb-4">
                          <a href="#"><i class="fa fa-facebook"></i></a>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                          <a href="#"><i class="fa fa-google-plus"></i></a>
                          <a href="#"><i class="fa fa-linkedin"></i></a>
                          <a href="#"><i class="fa fa-envelope"></i></a>
                        </div> --}}
                        {{-- <div>
                          <a href="#" class="primary-btn">Learn More</a>
                          <a href="#" class="heart-icon"
                            ><span class="icon_heart_alt"></span
                          ></a>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-12 d-flex justify-content-center text-center pt-4">
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Serving</h3>
                <h2>{{$cookbookitem->serving}}</h2>
              </div>
            </div>
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Ingredients</h3>
                <h2>{{count($ingredients)}}</h2>
              </div>
            </div>
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Prep Time</h3>
                <h2>{{$cookbookitem->timetoprepare}}</h2>
              </div>
            </div>
            <div class="recipe-info">
              <div class="recipe-info-text">
                <h3>Cooking Time</h3>
                <h2>{{$cookbookitem->timetocook}}</h2>
              </div>
            </div>
          </div>

          <div class="col-lg-12">
            <div class="product__details__tab">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    data-toggle="tab"
                    href="#tabs-1"
                    role="tab"
                    aria-selected="true"
                    >Ingredients</a
                  >
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    data-toggle="tab"
                    href="#tabs-2"
                    role="tab"
                    aria-selected="false"
                    >Steps</a
                  >
                </li>
                {{-- <li class="nav-item">
                  <a
                    class="nav-link"
                    data-toggle="tab"
                    href="#tabs-3"
                    role="tab"
                    aria-selected="false"
                    >Comments <span>(1)</span></a
                  >
                </li> --}}
              </ul>

              <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h3>Main Ingredients</h3>
                    <div class="row ingredient-bg">
                        @if (count($ingredients) == 0)
                            <p>No Ingredients Information</p>
                        @endif
                        @foreach ($ingredients as $ingredient)
                        @php
                            $productimage = DB::table('product_images')->where('product_id', $ingredient->product_id)->first();
                        @endphp
                            <div class="col-md-6 col-sm-6 ingredient-lg-4">
                                <div class="ingredient">
                                <div
                                    class="ingredient__pic set-bg"
                                    data-setbg="{{Storage::disk('uploads')->url($productimage->filename)}}"
                                    onclick="location.href='{{route('products', [$ingredient->product->slug, $ingredient->product_id])}}';" style="cursor: pointer"
                                ></div>
                                <div class="ingredient__text">
                                    <h6><a href="{{route('products', [$ingredient->product->slug, $ingredient->product_id])}}">{{$ingredient->item}}</a></h6>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-2" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h6>Cooking Steps</h6>
                    <pre>
                        {!! $cookbookitem->steps !!}
                      {{-- Step 1 :
                      Take a large non-stick pan and saute the pork bacon slices till they are crisp.
                      Step 2 :
                      Now chop the bacons into small pieces.
                      Step 3 :
                      Add chopped onions to the pan, drizzle olive oil and stir till they are soft.
                      Step 4 :
                      Pour in the sliced mushrooms, chopped bacons,garlic, pepper, salt and sage.
                      Step 5 : Stir till the mushrooms are brownish.
                      Step 6 : Add water/broth and simmer.
                      Step 7 : Sprinkle grated cheddar over the top surface, serve when the cheese melts. --}}
                    </pre>
                  </div>
                </div>
                {{-- <div class="tab-pane" id="tabs-3" role="tabpanel">
                  <div class="product__details__tab__desc">
                    <h6>Comments</h6>
                    <p>Here will be the reviews or comments</p>
                  </div>
                </div> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
      <div class="container">
      <div class="section-title">
        <h2>Shop Ingredients</h2>
      </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="shoping__cart__table">
              <table>
                <thead>
                  <tr>
                    <th class="shoping__product">Products</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ingredients as $ingredient)
                        @php
                            $productimage = DB::table('product_images')->where('product_id', $ingredient->product_id)->first();
                        @endphp
                        <tr>
                            <td class="shoping__cart__item">
                              <img src="{{Storage::disk('uploads')->url($productimage->filename)}}" alt="" style="max-width: 100px"/>
                              <h5>{{$ingredient->product->title}} ({{$ingredient->product->quantity}} {{$ingredient->product->unit}})</h5>
                            </td>
                            <td class="shoping__cart__price" style="color: #dd2222">
                                @if ($ingredient->product->discount > 0)
                                    @php
                                        $discountamount = ($ingredient->product->discount / 100) * $ingredient->product->price;
                                        $afterdiscount = $ingredient->product->price - $discountamount;
                                    @endphp
                                    Rs. {{ceil($afterdiscount)}} <span style="color: black; font-size: 18px;"><strike>Rs. {{$ingredient->product->price}}</strike><span>
                                @else
                                    Rs. {{$ingredient->product->price}}
                                @endif

                            </td>

                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                <td class="shoping__cart__quantity">

                                    <div class="quantity">
                                        @if ($ingredient->product->unit_info == 0)
                                            <p>Out of Stock</p>
                                        @else
                                            <div class="pro-qty">
                                                <input type="text" value="1" />

                                            </div>

                                            </div>
                                            ({{$ingredient->product->unit_info}} units available)
                                        @endif

                                </td>
                                <td>
                                    <a href="javascript:void(0)" onclick="openLoginModal();" class="primary-btn">ADD TO CART</a>
                                </td>
                            @else
                                <form action="{{route('addtocart', $ingredient->product->id)}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            @if ($ingredient->product->unit_info == 0)
                                                <p>Out of Stock</p>
                                                <input type="hidden" value="1" name="quantity"/>
                                            @else
                                                <div class="pro-qty">
                                                    <input type="text" value="1" name="quantity"/>

                                                </div>

                                                </div>
                                                ({{$ingredient->product->unit_info}} units available)
                                            @endif

                                    </td>

                                        @if ($ingredient->product->discount > 0)
                                            @php
                                                $discountamount = ($ingredient->product->discount / 100) * $ingredient->product->price;
                                                $afterdiscount = $ingredient->product->price - $discountamount;
                                            @endphp

                                            <input type="hidden" value="{{ceil($afterdiscount)}}" name="price" class="form-control">
                                        @else
                                            <input type="hidden" value="{{$ingredient->product->price}}" name="price" class="form-control">
                                        @endif
                                    <td>
                                        @php
                                            $existsincart = DB::table('carts')->where('user_id', Auth::user()->id)->where('product_id', $ingredient->product_id)->first();
                                        @endphp
                                        @if ($existsincart)
                                            <p>Already in cart</p>
                                        @else
                                            <button class="primary-btn" type="submit" style="border: none;">ADD TO CART</button>
                                        @endif


                                    </td>

                                </form>

                            @endif



                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Shoping Cart Section End -->




@endsection
