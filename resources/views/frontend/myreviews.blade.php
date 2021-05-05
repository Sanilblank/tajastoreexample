@extends('frontend.layouts.app')
@push('styles')
<style>
    a:hover,
    a:focus {
        text-decoration: none;
        outline: none;
        color: black;
    }
</style>
@endpush
@section('content')
<div class="main">

    <section class="py-5">
        <div class="container">
            <h2 class="red">My Reviews<hr></h2>
            @if (count($reviews) == 0)
            <p class="ml-3">No Reviews given by you</p>
            @endif

                                @foreach ($reviews as $review)
                                                    @php
                                                        $currentproduct = DB::table('products')->where('id', $review->product_id)->first();
                                                        $currentimage = DB::table('product_images')->where('product_id', $review->product_id)->first();
                                                    @endphp

                                                    <div class="co-item">

                                                        <h5 style="color: #b83955; margin-bottom:1rem;">Review of product <a href="{{route('products', ['slug' => $currentproduct->slug, 'id'=> $currentproduct->id])}}" class="hoverColor">{{$currentproduct->title}}</a></h5>
                                                        <div class="row">
                                                            <div class="col-md-3 text-center">
                                                                <div class="avatar-pic">
                                                                    <img src="{{Storage::disk('uploads')->url($currentimage->filename)}}" alt="" style="max-width: 200px">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="avatar-pic">
                                                                    <div class="avatar-text">
                                                                        <div class="at-rating mb-2">
                                                                            @for ($i = $review->rating; $i > 0; $i--)
                                                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                                            @endfor
                                                                            @for ($i =5 - $review->rating; $i > 0; $i--)
                                                                                <i class="fa fa-star-o" style="color: grey"></i>
                                                                            @endfor
                                                                        </div>
                                                                            <h5 class="mb-2">{{$currentproduct->title}} - <span>{{$review->updated_at->diffForHumans()}}</span></h5>
                                                                        <div class="at-reply mb-2">{{$review->description}}</div>
                                                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editreviewModal{{$currentproduct->id . Auth::user()->id}}">&nbsp; Edit &nbsp;</button>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="editreviewModal{{$currentproduct->id . Auth::user()->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                    <h5 class="modal-title" id="editreviewModalLabel">Update your Review</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                    </div>
                                                                                    <form action="{{route('updatereview', $review->id)}}" method="POST">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <div class="modal-body">
                                                                                                <div class="form-group">
                                                                                                    <div class="container d-flex justify-content-center">
                                                                                                        <div class="row">
                                                                                                            <div class="col-md-2">
                                                                                                            </div>
                                                                                                            <div class="col-md-9">
                                                                                                                <div class="stars">
                                                                                                                    <input class="star star-5" id="starrating-5{{$currentproduct->id . Auth::user()->id}}" type="radio" name="star" value="5"

                                                                                                                    @if ($review->rating == 5)
                                                                                                                        checked
                                                                                                                    @endif />
                                                                                                                    <label class="star star-5" for="starrating-5{{$currentproduct->id . Auth::user()->id}}"></label>
                                                                                                                    <input class="star star-4" id="starrating-4{{$currentproduct->id . Auth::user()->id}}" type="radio" name="star" value="4"

                                                                                                                    @if ($review->rating == 4)
                                                                                                                        checked
                                                                                                                    @endif />
                                                                                                                    <label class="star star-4" for="starrating-4{{$currentproduct->id . Auth::user()->id}}"></label>
                                                                                                                    <input class="star star-3" id="starrating-3{{$currentproduct->id . Auth::user()->id}}" type="radio" name="star" value="3"

                                                                                                                    @if ($review->rating == 3)
                                                                                                                        checked
                                                                                                                    @endif />
                                                                                                                    <label class="star star-3" for="starrating-3{{$currentproduct->id . Auth::user()->id}}"></label>
                                                                                                                    <input class="star star-2" id="starrating-2{{$currentproduct->id . Auth::user()->id}}" type="radio" name="star" value="2"

                                                                                                                    @if ($review->rating == 2)
                                                                                                                        checked
                                                                                                                    @endif />
                                                                                                                    <label class="star star-2" for="starrating-2{{$currentproduct->id . Auth::user()->id}}"></label>
                                                                                                                    <input class="star star-1" id="starrating-1{{$currentproduct->id . Auth::user()->id}}" type="radio" name="star" value="1"

                                                                                                                    @if ($review->rating == 1)
                                                                                                                        checked
                                                                                                                    @endif />
                                                                                                                    <label class="star star-1" for="starrating-1{{$currentproduct->id . Auth::user()->id}}"></label>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-12">
                                                                                                                <textarea rows="4" cols="40" class="form-control" placeholder="Describe your experience (optional)" name="ratingdescription">{{$review->description}}</textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Modal Ends -->

                                                                            <form action="{{route('deleteuserreview', $review->id)}}" method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                                                            </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <hr>
                                    @endforeach


            <div class="row mt-5 mb-5" style="text-align: center">
                <div class="col-md-12">
                    {{ $reviews->links() }}
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')

@endpush

