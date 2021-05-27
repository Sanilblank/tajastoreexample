@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Create Category <a href="{{ route('cookbookcategory.index') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-eye" aria-hidden="true"></i> View Category</a></h1>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mt-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('cookbookcategory.store') }}" method="POST" class="bg-light p-3"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="cookbooknavbar_id">Select NavBar Item</label>
                                            <select name="cookbooknavbar_id" id="" class="form-control">

                                                @foreach ($navbaritems as $item)
                                                    <option value="{{ $item->id }}">{{ $item->navbar_item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Title: </label>
                                            <input type="text" name="category" class="form-control" value="{{ @old('category') }}"
                                                placeholder="Enter Title">
                                            @error('category')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="status">Status: </label>
                                                    <input type="radio" name="status" value="1"> Active
                                                    <input type="radio" name="status" value="0"> Inactive
                                                    @error('status')
                                                        <p class="text-danger">{{ $message }}</p>
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
                </div>

    </div>

@endsection
@push('scripts')

@endpush
