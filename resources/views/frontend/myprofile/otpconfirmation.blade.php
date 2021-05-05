@extends('frontend.layouts.app')
@section('content')


<section class="ftco-section bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-1 col-lg-2 order-md-last">
            </div>
            <div class="col-md-10 col-lg-8 order-md-last">
                <div class="card">
                    <div class="card-header">
                        <h4 class="billing-heading text-center mt-2 mb-2">My Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h3 class="billing-heading mb-3">Edit Info</h3>
                                <form action="{{route('otpvalidation')}}" method="get">
                                    @csrf
                                    <div class="form-group">
                                        <p>We have sent a verification code to your registered mail. Please enter the code below.
                                            Code expires in 10 minutes.
                                        </p>
                                        <input type="text" name="otpcode" class="form-control" placeholder="Enter your code." required>
                                        @error('otpcode')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                        <br>
                                        <button type="submit" name="submit" class="site-btn">Confirm</button>
                                        <a href="{{route('sendotp')}}" class="site-btn">Resend</a>
                                    </div>

                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 col-lg-2 order-md-last">
            </div>

        </div>
    </div>
</section>

@endsection
