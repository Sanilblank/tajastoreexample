@extends('frontend.layouts.app')
@section('content')

<section class="ftco-section bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12 col-lg-12 order-md-last">
                <div class="card">
                    <div class="card-header">
                        <h4 class="billing-heading text-center mt-2 mb-2">My Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="billing-heading mb-3 text-center">Edit Info</h3>
                                <form action="{{route('sendemailchange')}}" method="POST">
                                    @csrf
                                    @method('GET')
                                    <div class="row">
                                        <div class="col-md-2">
                                            <b>Name:</b>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <b>Email:</b>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="email" class="form-control" value="{{$user->email}}">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button type="submit" class="site-btn">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
