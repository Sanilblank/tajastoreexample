<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
@php
    $setting = DB::table('settings')->first();
    $offerproducts = DB::table('products')->where('discount', '>', 0)->get();
@endphp
<!-- Humberger Begin -->
<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
        <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="" style="max-width: 150px; max-height: 170px;"></a>
    </div>
    <div class="humberger__menu__cart">
        <ul>
            @if (Auth::guest() || Auth::user()->role_id != 3)
                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart"></i> <span>0</span></a></li>
                <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-shopping-bag"></i> <span>0</span></a></li>
            @elseif(Auth::user()->role_id==3)
                @php
                    $cartproducts = DB::table('carts')->where('user_id', Auth::user()->id)->get();
                    $wishlistproducts = DB::table('wishlists')->where('user_id', Auth::user()->id)->get();
                @endphp
                <li><a href="{{route('wishlist')}}"><i class="fa fa-heart"></i> <span>{{count($wishlistproducts)}}</span></a></li>
                <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{count($cartproducts)}}</span></a></li>
            @endif
        </ul>
        {{-- <div class="header__cart__price">item: <span>$150.00</span></div> --}}
    </div>
    {{-- <div class="humberger__menu__widget">
        <div class="header__top__right__auth">
        </div>
    </div> --}}
    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li>
                @if (Auth::guest() || Auth::user()->role_id != 3)
                                <a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-user"></i> Login</a>
                            @elseif(Auth::user()->role_id==3)<a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                <ul class="header__menu__dropdown text-center">
                                    <li><a href="{{route('myaccount')}}">My Account</a></li>
                                    <li><a href="{{route('myprofile')}}">My Profile</a></li>
                                    <li><a href="{{route('myorders')}}">My Orders</a></li>
                                    <li><a href="{{route('cart')}}">My Cart</a></li>
                                    <li><a href="{{route('wishlist')}}">My Wishlist</a></li>
                                    <li><a href="{{route('myreviews')}}">My Reviews</a></li>
                                    <li><form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                    Logout
                                            </a>
                                        </form>
                                    </li>
                            @endif
                </ul>
            </li>
            <li class="active"><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('shop') }}">Shop</a></li>
            @if (count($offerproducts) > 0)
                <li><a href="{{route('offers')}}">Sale</a></li>
            @endif
            {{-- <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown text-center">
                    <li><a href="./shop-details.html">Shop Details</a></li>
                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="./checkout.html">Check Out</a></li>
                    <li><a href="./blog-details.html">Blog Details</a></li>
                </ul>
            </li> --}}
            <li><a href="{{ route('requestProduct') }}">Request Product</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            {{-- <li><a href="{{route('about')}}">About Us</a></li> --}}
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="{{$setting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
        <a href="{{$setting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
        {{-- <a href="#"><i class="fa fa-linkedin"></i></a> --}}
        {{-- <a href="#"><i class="fa fa-pinterest-p"></i></a> --}}
    </div>
    <div class="humberger__menu__contact">
        <ul>
            <li><i class="fa fa-envelope"></i> {{$setting->email}}</li>
            {{-- <li>Free Shipping for all Order of Rs. 500</li> --}}
        </ul>
    </div>
</div>
<!-- Humberger End -->

<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> {{$setting->email}}</li>
                            {{-- <li>Free Shipping for all Order of Rs. 500</li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="{{$setting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="{{$setting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                        <div class="header__top__right__auth">
                            @if (Auth::guest() || Auth::user()->role_id != 3)
                                <a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-user"></i> Login</a>
                            @elseif(Auth::user()->role_id==3)
                                <nav class="header__menu py-0">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                            <ul class="header__menu__dropdown text-center">
                                                <li><a href="{{route('myaccount')}}">My Account</a></li>
                                                <li><a href="{{route('myprofile')}}">My Profile</a></li>
                                                <li><a href="{{route('myorders')}}">My Orders</a></li>
                                                <li><a href="{{route('cart')}}">My Cart</a></li>
                                                <li><a href="{{route('wishlist')}}">My Wishlist</a></li>
                                                <li><a href="{{route('myreviews')}}">My Reviews</a></li>
                                                <li><form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                                Logout
                                                        </a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="{{ route('index') }}"><img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="" style="max-width: 150px; max-height: 170px;"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        @if (count($offerproducts) > 0)
                            <li><a href="{{route('offers')}}">Sale</a></li>
                        @endif
                        {{-- <li><a href="#">Pages</a>
                            <ul class="header__menu__dropdown">
                                <li><a href="./shop-details.html">Shop Details</a></li>
                                <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                <li><a href="./checkout.html">Check Out</a></li>
                                <li><a href="./blog-details.html">Blog Details</a></li>
                            </ul>
                        </li> --}}
                        {{-- <li><a href="./blog.html">Blog</a></li> --}}
                        <li><a href="{{ route('requestProduct') }}">Request Product</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        {{-- <li><a href="{{route('about')}}">About Us</a></li> --}}
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul class="nav-right">
                        @if (Auth::guest() || Auth::user()->role_id != 3)
                            <li><a href="javascript:void(0)" onclick="openLoginModal();"><i class="fa fa-heart"></i> <span>0</span></a></li>
                            <li class="cart-icon"><a href="javascript:void(0)" onclick="openLoginModal();" ><i class="fa fa-shopping-bag"></i> <span>0</span> </a>


                           </li>
                           {{-- <li class="cart-price">Rs.2000</li> --}}
                        @elseif(Auth::user()->role_id==3)
                            @php
                                $cartproducts = DB::table('carts')->where('user_id', Auth::user()->id)->latest()->get();
                                $wishlistproducts = DB::table('wishlists')->where('user_id', Auth::user()->id)->get();
                            @endphp
                            <li><a href="{{route('wishlist')}}"><i class="fa fa-heart"></i> <span>{{count($wishlistproducts)}}</span></a></li>
                            <li class="cart-icon"><a href="{{ route('cart') }}"><i class="fa fa-shopping-bag"></i> <span>{{count($cartproducts)}}</span></a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                @foreach ($cartproducts as $cartproduct)
                                                    @php
                                                        $product = DB::table('products')->where('id', $cartproduct->product_id)->first();
                                                        $productimage = DB::table('product_images')->where('product_id', $product->id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td class="si-pic"><img src="{{Storage::disk('uploads')->url($productimage->filename)}}" alt="" style="max-width: 100px;"></td>
                                                        <td class="si-text">
                                                            <div class="product-selected">
                                                                <p>Rs.{{$cartproduct->price}} x {{$cartproduct->quantity}}</p>
                                                                <h6>{{$product->title}}</h6>
                                                            </div>
                                                        </td>
                                                        <td class="si-close">
                                                            <i class="ti-close"></i>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="select-total">
                                        <span>Total:</span>
                                        <h5>$120.00</h5>
                                    </div> --}}
                                    <div class="select-button">
                                        <a href="{{ route('cart') }}" class="primary-btn view-card">VIEW CART</a>
                                        <a href="{{route('checkout', Auth::user()->id)}}" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->


<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="dropdown">
                    @php
                        $categories = DB::table('categories')->latest()->get();
                    @endphp
                    <button class="btn btn-success categorydrop humberger__open2" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bars px-4"></i>
                      All Departments
                    </button>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        @foreach ($categories as $category)
                        <li class="dropdown-submenu">
                            <a  class="dropdown-item" tabindex="-1" href="#">{{$category->title}}</a>
                            <ul class="dropdown-menu">
                                @php
                                    $subcategories = DB::table('subcategories')->where('category_id', $category->id)->get();
                                @endphp
                                @if (count($subcategories) > 0)
                                    @foreach ($subcategories as $item)
                                        <li class="dropdown-item"><a href="{{route('subcategories', $item->slug)}}">{{$item->title}}</a></li>
                                    @endforeach
                                @else
                                    <li class="dropdown-item"><a href="#">No Subcategories</a></li>

                                @endif

                            </ul>
                          </li>
                        @endforeach
                      </ul>
                </div>

<!-- Testing -->
<div class="humberger__menu__overlay2"></div>
<div class="humberger__menu__wrapper2">
    <div class="humberger__menu__logo">
        <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->headerImage)}}" alt="" style="max-width: 150px; max-height: 170px;"></a>
    </div>
    <nav class="humberger__menu__nav2 mobile-menu-cat">
    @php
                        $categories = DB::table('categories')->latest()->get();
                    @endphp
        <ul>
        @foreach ($categories as $category)

            <li><a href="#">{{$category->title}}</a>
                <ul class="header__menu__dropdown text-center">
                @php
                                    $subcategories = DB::table('subcategories')->where('category_id', $category->id)->get();
                                @endphp
                                @if (count($subcategories) > 0)
                                    @foreach ($subcategories as $item)
                                    <li><a href="{{route('subcategories', $item->slug)}}">{{$item->title}}</a></li>
                                    @endforeach
                                    @else
                                    <li><a href="#">No Subcategories</a></li>
                                @endif
                </ul>
            </li>

            @endforeach
        </ul>
    </nav>
    <div id="mobile-menu-cat-wrap"></div>
</div>






            </div>










            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        {{-- <form action="#">
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form> --}}

                        <div class="aa-input-container" id="aa-input-container">
                            <input type="search" id="aa-search-input-algolia" class="aa-input-search" placeholder="What do you need???" name="search"
                                autocomplete="off" />
                            <svg class="aa-input-icon" viewBox="654 -372 1664 1664">
                                <path d="M1806,332c0-123.3-43.8-228.8-131.5-316.5C1586.8-72.2,1481.3-116,1358-116s-228.8,43.8-316.5,131.5  C953.8,103.2,910,208.7,910,332s43.8,228.8,131.5,316.5C1129.2,736.2,1234.7,780,1358,780s228.8-43.8,316.5-131.5  C1762.2,560.8,1806,455.3,1806,332z M2318,1164c0,34.7-12.7,64.7-38,90s-55.3,38-90,38c-36,0-66-12.7-90-38l-343-342  c-119.3,82.7-252.3,124-399,124c-95.3,0-186.5-18.5-273.5-55.5s-162-87-225-150s-113-138-150-225S654,427.3,654,332  s18.5-186.5,55.5-273.5s87-162,150-225s138-113,225-150S1262.7-372,1358-372s186.5,18.5,273.5,55.5s162,87,225,150s113,138,150,225  S2062,236.7,2062,332c0,146.7-41.3,279.7-124,399l343,343C2305.7,1098.7,2318,1128.7,2318,1164z" />
                            </svg>
                        </div>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>{{$setting->phone}}</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->
    @if (session('success'))
        <div class="row">
            <div class="col-sm-4 ml-auto message scroll">
                <div class="alert  alert-success alert-dismissible fade show" role="alert" style="background: seagreen; color: white;">
                {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    {{-- @if (session()->has('failure'))
        <div class="alert alert-danger mt-2">{{ session('failure') }}</div>
    @endif --}}

    @if (session('failure'))
        <div class="row">
            <div class="col-sm-4 ml-auto message scroll">
                <div class="alert  alert-danger alert-dismissible fade show" role="alert" style="background: rgb(134, 7, 7); color: white;">
                {{ session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
