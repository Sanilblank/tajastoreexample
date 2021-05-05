@extends('frontend.layouts.app')
@push('styles')
<style>
    a:hover,
    a:focus {
        text-decoration: none;
        outline: none;
        color: seagreen;
    }
</style>
@endpush
@section('content')

    {{-- @if (session('success'))
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
    @endif --}}

<section class="ftco-section bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-1 order-md-last">
            </div>
            <div class="col-md-12 col-lg-10 order-md-last">
                <div class="card">
                    <div class="card-header">
                        <h4 class="billing-heading text-center mt-2 mb-2">My Account</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="billing-heading mt-3 mb-3">Basic Info | <a href="{{route('myprofile')}}">Edit</a></h4>
                                <div class="row">
                                    <div class="col-md-3">
                                        <b>Name:</b>
                                    </div>
                                    <div class="col-md-9">
                                        {{$user->name}}
                                    </div>

                                    <div class="col-md-3">
                                        <b>Email:</b>
                                    </div>
                                    <div class="col-md-9">
                                        {{$user->email}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                @if ($delieveryaddress == null)
                                <h4 class="billing-heading mt-3 mb-3">My Address (Default)</h4>
                                    No default address.<br>
                                    Your default address will appear when you will order your first product.
                                @else
                                <h4 class="billing-heading mt-3 mb-3">My Address (Default) | <a href="{{route('editcustomeraddress')}}">Edit</a></h4>
                                    {{$delieveryaddress->address}}, {{$delieveryaddress->town}},<br>
                                    {{$delieveryaddress->district}} ({{$delieveryaddress->postcode}}), Nepal<br>
                                    +977 {{$delieveryaddress->phone}}
                                @endif

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
