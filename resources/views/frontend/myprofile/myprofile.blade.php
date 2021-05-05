@extends('frontend.layouts.app')
@section('content')

<section class="ftco-section bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-1 order-md-last">
            </div>
            <div class="col-md-12 col-lg-10 order-md-last">
                <div class="card">
                    <div class="card-header">
                        <h4 class="billing-heading text-center mt-2 mb-2">My Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <b>Name:</b>
                                    </div>
                                    <div class="col-md-10">
                                        {{$user->name}}
                                    </div>
                                    <br>
                                    <div class="col-md-2">
                                        <b>Email:</b>
                                    </div>
                                    <div class="col-md-10">
                                        {{$user->email}}<br><br>
                                        <a href="{{route('editinfo')}}" class="site-btn">&nbsp;&nbsp;Edit Info&nbsp;&nbsp;</a>&nbsp;
                                        <a href="{{route('sendotp')}}" class="site-btn">Edit Password</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 order-md-last">
            </div>


        </div>
    </div>
</section>

@endsection
