@extends('frontend.layouts.app')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg mt-3" style="background-repeat: no-repeat; background-size:cover;background-position:top center;" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('index') }}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{ route('placeorder')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row form-group">
                        <div class="col-lg-7 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" required name="firstname" class="form-control" placeholder="Your First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" required name="lastname" class="form-control" placeholder="Your Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" required name="phone" class="form-control" placeholder="Your phone no.">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" required name="email" class="form-control" placeholder="Your email address">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" required placeholder="Street Address / Tole (Ex: Swoyambhu-15)" class="form-control" name="address">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" required placeholder="Ex: Kathmandu" name="town" class="form-control">
                            </div>
                            <div class="checkout__input">
                                <p>District<span>*</span></p>
                                <input type="text" required class="form-control" placeholder="District you live in" name="district">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" required name="postcode" class="form-control" placeholder="Ex: 44600">
                            </div>
                            {{-- <div class="checkout__input">
                                <input type="checkbox" class="form-control" name="delievery"> Inside Ring Road
                            </div> --}}
                        </div>
                        <div class="col-lg-5 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach ($cartproducts as $product)
                                        @php
                                            $real_product = DB::table('products')->where('id', $product->product_id)->first();
                                        @endphp
                                        <li>{{$real_product->title}} ({{$product->quantity}} * Rs. {{$product->price}}) <span>Rs. {{$product->quantity * $product->price}}</span></li>
                                    @endforeach
                                </ul>
                                @php
                                    $grandtotal = 0;
                                    foreach ($cartproducts as $product) {
                                        $grandtotal = $grandtotal + ($product->price * $product->quantity);
                                    }
                                @endphp
                                <div class="checkout__order__subtotal">Subtotal <span>Rs. {{$grandtotal}}</span></div>
                                <div class="checkout__order__subtotal">Delievery Charge <span>Rs. 50</span></div>
                                <div class="checkout__order__total">Total <span>Rs. {{$grandtotal + 50}}</span></div>
                                {{-- <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p> --}}
                                    {{-- <input type="radio" name="payment" class="form-control" style="width: 7%;">Cash on Delievery
                                    <input type="radio" name="payment" class="form-control" style="width: 7%;">Esewa --}}
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
