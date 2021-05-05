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
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="billing-heading mb-5 text-center">Change Password</h3>
                                <form action="{{route('updatepassword')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">Old Password:</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" name="oldpassword" placeholder="Old Password" required><br>
                                                    @error('oldpassword')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                    @if ($message = Session::get('oldfailure'))
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @endif
                                                </div>
                                        </div>

                                        <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">New Password:</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" name="newpassword" placeholder="New Password" required> <br>
                                                    @error('newpassword')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                    @if ($message = Session::get('samepass'))
                                                            <p class="text-danger">{{ $message }}</p>
                                                    @endif
                                                </div>
                                        </div>

                                        <div class="row">
                                                <div class="col-md-3">
                                                    <label for="">Confirm Password:</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" name="newpassword_confirmation" placeholder="Confirm new Password" required> <br>
                                                    @error('newpassword_confirmation')
                                                        <p class="text-danger">{{$message}}</p>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" class="site-btn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
