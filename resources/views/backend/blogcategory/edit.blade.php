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
        <h1 class="mt-3">Edit Blog Category => {{$blogCategory->name}} <a href="{{ route('blogcategory.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Blog Category</a></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mt-3">


                                <form action="{{ route('blogcategory.update', $blogCategory->id) }}" method="POST" class="bg-light p-3">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Category Name: </label>
                                                <input type="text" name="name" class="form-control" value="{{@old('name')?@old('name'):$blogCategory->name}}" placeholder="Category Name">
                                                @error('name')
                                                    <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
    </div>


@endsection
@push('scripts')

@endpush
