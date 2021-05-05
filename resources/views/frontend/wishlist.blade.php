@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index')}}">Home</a>
                            <span>My Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table table table-responsive">
                        <table>
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Products</th>
                                    <th>Department</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($wishlistproducts) == 0)
                                    <tr class="text-center">
                                        <td  colspan="4" class="shoping__cart__total">No products in wishlist yet.</td>
                                    </tr>
                                @else
                                    @foreach ($wishlistproducts as $product)
                                        <tr class="text-center">
                                            <td>
                                                @php
                                                    $productimage = DB::table('product_images')->where('product_id', $product->product_id)->first();
                                                    $real_product = DB::table('products')->where('id', $product->product_id)->first();
                                                    $subcategory = DB::table('subcategories')->where('id', $real_product->subcategory_id)->first();
                                                @endphp
                                                <img src="{{Storage::disk('uploads')->url($productimage->filename)}}" alt="{{$real_product->title}}" style="max-width: 100px; max-height: 150px;">
                                            </td>
                                            <td>
                                                <div class="product__discount__item__text">
                                                    <div class="product__item__price" style="color: black;">{{$real_product->title}} ({{$real_product->quantity}} {{$real_product->unit}})</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product__discount__item__text">
                                                    <div class="product__item__price" style="color: black;">{{$subcategory->title}}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="product__discount__item__text">
                                                    @if ($real_product->discount > 0)
                                                        @php
                                                            $discountamount = ($real_product->discount / 100) * $real_product->price;
                                                            $afterdiscount = $real_product->price - $discountamount;
                                                        @endphp

                                                        <div class="product__item__price" style="color: black;">Rs. {{$afterdiscount}} <span>Rs. {{$real_product->price}}</span></div>
                                                        <p>({{$real_product->discount}} % OFF)</p>
                                                    @else
                                                        <div class="product__item__price" style="color: black;">Rs. {{$real_product->price}} </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{route('removefromwishlist', $real_product->id)}}"><span class="icon_close" title="Remove from wishlist"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="shoping__cart__btns">
                        <a href="{{route('shop')}}" class="primary-btn site-btn">Go to SHOP</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
