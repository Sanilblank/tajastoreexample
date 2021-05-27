@extends('backend.layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css"
        integrity="sha256-n3YISYddrZmGqrUgvpa3xzwZwcvvyaZco0PdOyUKA18=" crossorigin="anonymous" />

        <!-- Algolia Search -->
    <link rel="stylesheet" href="{{ asset('backend/css/maps/addalgolia.css') }}">
@endpush
@section('content')
    <div class="right_col" role="main">
        @if (session('success'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
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
        <h1 class="mt-3">Create Item => {{$navbaritem->navbar_item}} <a href="{{ route('cookbookitem.index', $navbaritem->id) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-eye" aria-hidden="true"></i> View Items</a></h1>

                        <div class="card mt-3">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('cookbookitem.store') }}" method="POST" class="bg-light p-3"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" value="{{$navbaritem->id}}" name="cookbooknavbar_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cookbookcategory_id">Select Category</label>
                                                    <select name="cookbookcategory_id" class="form-control">

                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}">{{ $item->category }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cookbooksubcategory_id">Select SubCategory</label>
                                                    <select name="cookbooksubcategory_id" class="form-control">

                                                        @foreach ($subcategories as $item)
                                                            <option value="{{ $item->id }}">{{ $item->subcategory }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="itemname">Name of Item: </label>
                                                    <input type="text" name="itemname" class="form-control" value="{{ @old('itemname') }}"
                                                        placeholder="Enter Item Name">
                                                    @error('itemname')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="itemimage">Item Image: </label>
                                                    <input type="file" name="itemimage" class="form-control">
                                                    @error('itemimage')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recipeby">Recipe By: </label>
                                                    <input type="text" name="recipeby" class="form-control" value="{{ @old('recipeby') }}"
                                                        placeholder="Enter name of person who gave recipe">
                                                    @error('recipeby')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recipebyimage">Author Image: </label>
                                                    <input type="file" name="recipebyimage" class="form-control">
                                                    @error('recipebyimage')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="serving">Serving: </label>
                                                    <input type="text" name="serving" class="form-control" value="{{ @old('serving') }}"
                                                        placeholder="No of serving, Eg:3">
                                                    @error('serving')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="timetoprepare">Time to Prepare: </label>
                                                    <input type="text" name="timetoprepare" class="form-control" value="{{ @old('timetoprepare') }}"
                                                        placeholder="Time required for preparation, Eg:15 min">
                                                    @error('timetoprepare')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="timetocook">Time to Cook: </label>
                                                    <input type="text" name="timetocook" class="form-control" value="{{ @old('timetocook') }}"
                                                        placeholder="Time required for cooking, Eg:30 min">
                                                    @error('timetocook')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Small Description:</label>
                                                    <textarea name="description" class="form-control" id="description" cols="30" rows="10"
                                                        placeholder="Enter Item Description"></textarea>

                                                    @error('description')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="course">Course: </label>
                                                    <input type="text" name="course" class="form-control" value="{{ @old('course') }}"
                                                        placeholder="Eg:Soups">
                                                    @error('course')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cuisine">Cuisine: </label>
                                                    <input type="text" name="cuisine" class="form-control" value="{{ @old('cuisine') }}"
                                                        placeholder="Eg:American">
                                                    @error('cuisine')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="timeofday">Time of Day: </label>
                                                    <input type="text" name="timeofday" class="form-control" value="{{ @old('timeofday') }}"
                                                        placeholder="Eg:Dinner">
                                                    @error('timeofday')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="levelofcooking_id">Select Level of Cooking</label>
                                                    <select name="levelofcooking_id" class="form-control">

                                                        @foreach ($levels as $item)
                                                            <option value="{{ $item->id }}">{{ $item->level }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="recipetype_id">Select Recipe Type</label>
                                                    <select name="recipetype_id" class="form-control">

                                                        @foreach ($recipetypes as $item)
                                                            <option value="{{ $item->id }}">{{ $item->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="steps">Steps for Cooking Item:</label>
                                                    <textarea name="steps" class="form-control" id="steps" cols="30" rows="10"
                                                        placeholder="Write Steps"></textarea>

                                                    @error('steps')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
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

                        <div class="card mt-3">
                            <div class="card-header h5">Ingredients Section:</div>
                            <div class="card-body">
                                            <form action="{{route('storeingredient')}}" method="POST">
                                                @csrf
                                                @method('POST')
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">

                                                                <div class="aa-input-container" id="aa-input-container">
                                                                    <input type="text" id="aa-search-input" class="aa-input-search" placeholder="Search Product" name="product_id" value="{{@old('product_id')}}"
                                                                    autocomplete="off" />
                                                                </div>
                                                                @error('product_id')
                                                                    <p class="text-danger">{{$message}}</p>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <input type="text" class="form-control" placeholder="Text to display. Eg:2 spoons of Salt" name="item">
                                                            @error('item')
                                                                <p class="text-danger">{{$message}}</p>
                                                            @enderror
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button class="btn btn-primary" type="submit">+ Add</button>
                                                        </div>
                                                    </div>
                                            </form>

                                            @if (count($ingredients) > 0)
                                            @php
                                                $i = 1;
                                            @endphp
                                            <table class="table table-striped">
                                                <thead>
                                                  <tr>
                                                    <th>SN.</th>
                                                    <th>Photo</th>
                                                    <th>Item Name</th>
                                                    <th>Description</th>
                                                    <th colspan="2">Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ingredients as $ingredient)
                                                    @php
                                                        $productimage = DB::table('product_images')->where('product_id', $ingredient->product_id)->first();
                                                    @endphp
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td><img src="{{Storage::disk('uploads')->url($productimage->filename)}}" style="max-height: 70px"> </td>
                                                        <td>{{$ingredient->product->title}}</td>
                                                        <td>{{$ingredient->item}}</td>
                                                        <td style="vertical-align: inherit">

                                                            <form action="{{route('removeingredient', $ingredient->id)}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger remove" title="Cancel this item">x</button>
                                                               </form>
                                                        </td>

                                                      </tr>
                                                    @endforeach


                                                </tbody>
                                              </table>
                                            @else

                                              <p class="h6">No ingredients added for this recipe.</p>
                                            @endif
                            </div>
                        </div>


    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('backend/js/addalgolia.js') }}"></script>
    <script>
        $('#description').summernote({
            height: 80,

        });
        $('#steps').summernote({
            height: 200,

        });

    </script>
@endpush
