@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Create Slider Image <a href="{{ route('slider.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-eye" aria-hidden="true"></i> View Sliders</a></h1>
        <div class="card mt-3">

            <form action="{{ route('slider.store') }}" method="POST" class="bg-light p-3" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subtitle">Subtitle: </label>
                            <input type="text" name="subtitle" class="form-control" placeholder="Subtitle">
                            @error('subtitle')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input type="text" name="title" class="form-control" placeholder="Title">
                            @error('title')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description :</label><br>
                    <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="Write about the title..."></textarea>
                    @error('description')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    <p class="text-danger">Note*: Multiple images selected will have the same description.</p>
                </div>
                <div class="form-group">
                    <label for="image">Select Multiple Images</label>
                    <input type="file" name="images[]" id="uploads" class="form-control" multiple>
                    @error('images')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
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
