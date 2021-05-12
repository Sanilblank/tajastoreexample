@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        @if (session('failure'))
        <div class="col-sm-12">
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                {{ session('failure') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <h1 class="mt-3">Show Blog <a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Blogs</a></h1>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <p><b>Title:</b> {{$blog->title}}</p>
                                    <p><b>Category:</b> {{$category}}</p>
                                    <p><b>Date:</b> {{date('Y/m/d h:m a', strtotime($blog->date))}}</p>
                                    <p><b>Author:</b> {{$blog->authorname}}</p>
                                    <p><b>View Count:</b> {{$blog->view_count}}</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{Storage::disk('uploads')->url($blog->image)}}" alt="{{$blog->title}}" style="max-height: 200px; max-width: 350px;">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <p><b>Details: </b></p>
                                    {!! $blog->details !!}
                                </div>
                            </div>
                        </div>
                    </div>


    </div>


@endsection
@push('scripts')

@endpush
