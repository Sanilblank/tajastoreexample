@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route('index')}}">Home</a>
                            <span>My Cart</span>
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
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="shoping__cart__table table table-responsive">
                        <table>
                            <thead class="thead-light">
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($cartproducts) == 0)
                                    <tr class="text-center">
                                        <td colspan="4" class="shoping__cart__total">No products in cart yet.</td>
                                    </tr>
                                @else
                                    @foreach ($cartproducts as $product)
                                        <tr>
                                            <td class="shoping__cart__item">
                                                @php
                                                    $productimage = DB::table('product_images')->where('product_id', $product->product_id)->first();
                                                    $real_product = DB::table('products')->where('id', $product->product_id)->first();
                                                @endphp
                                                <img src="{{Storage::disk('uploads')->url($productimage->filename)}}" alt="{{$real_product->title}}" style="max-width: 150px;">
                                                <h5 style="font-size: 20px; font-weight: 600">{{$real_product->title}} ({{$real_product->quantity}} {{$real_product->unit}})</h5>
                                            </td>
                                            <td class="shoping__cart__price">
                                                @if ($real_product->discount > 0)
                                                    @php
                                                        $discountamount = ($product->discount / 100) * $product->price;
                                                        $afterdiscount = $product->price - $discountamount;
                                                    @endphp
                                                    Rs. {{$product->price}}<p style="font-weight: 500; color: grey"><strike>Rs. {{$real_product->price}}</strike> ({{$real_product->discount}} % off)</p>
                                                @else
                                                    Rs. {{$real_product->price}}
                                                @endif
                                            </td>
                                            <td class="shoping__cart__quantity">
                                                <div class="quantity">
                                                    <form action="{{route('updatequantity', $product->id)}}" method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="pro-qty form-group">
                                                            <input type="text" value="{{$product->quantity}}" min="1" name="quantity">
                                                        </div>
                                                        <a href="#" class="primary-btn site-btn mb-1" onclick="this.parentNode.submit()">Update</a>
                                                    </form>
                                                    <p>(Total In Stock: {{$real_product->unit_info}} units)</p>
                                                </div>
                                            </td>
                                            <td class="shoping__cart__total">
                                                @php
                                                    $total = $product->price * $product->quantity;
                                                @endphp
                                                Rs. {{$total}}
                                            </td>
                                            <td class="shoping__cart__item__close">
                                                <a href="{{route('removefromcart', $product->id)}}"><span class="icon_close"></span></a>
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
                <div class="col-lg-6">
                    <div class="shoping__cart__btns">
                        @if (count($cartproducts) == 0)
                            <a href="{{route('shop')}}" class="primary-btn site-btn">Go SHOPPING</a>
                        @else
                            <a href="{{route('shop')}}" class="primary-btn site-btn">CONTINUE SHOPPING</a>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5 class="text-center">Cart Total</h5>
                        <ul>
                            @if (count($cartproducts) == 0)
                                <li>Subtotal <span>Rs. 0</span></li>
                                <li>Total <span>Rs. 0</span></li>
                            @else
                            @php
                                $grandtotal = 0;
                                foreach ($cartproducts as $product) {
                                    $grandtotal = $grandtotal + ($product->price * $product->quantity);
                                }
                            @endphp
                                <li>Subtotal <span>Rs. {{$grandtotal}}</span></li>
                                <li>Total <span>Rs. {{$grandtotal}}</span></li>
                            @endif
                        </ul>
                        <a href="{{route('checkout', Auth::user()->id)}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection
