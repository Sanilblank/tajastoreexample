@extends('backend.layouts.app')
@push('styles')

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
        <h1 class="mt-3">Create Item => {{$cookbookitem->itemname}} <a href="{{ route('cookbookitem.index', $cookbookitem->navbar->id) }}" class="btn btn-primary btn-sm">
                <i class="fa fa-eye" aria-hidden="true"></i> View Items</a></h1>

                        <div class="card mt-3">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="font-size: 16px;">NavBar: {{$cookbookitem->navbar->navbar_item}}</p>
                                    <p style="font-size: 16px;">Category: {{$cookbookitem->category->category}}</p>
                                    <p style="font-size: 16px;">SubCategory: {{$cookbookitem->subcategory->subcategory}}</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p style="font-size: 16px;">Recipe By: {{$cookbookitem->recipeby}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-size: 16px;">Author Image:</p>
                                            <img src="{{Storage::disk('uploads')->url($cookbookitem->recipebyimage)}}" style="max-height: 50px">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center">
                                    <p style="font-size: 16px;">Item Image:</p>
                                    <img src="{{Storage::disk('uploads')->url($cookbookitem->itemimage)}}" style="max-height: 200px;">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="font-size: 16px;">Serving: {{$cookbookitem->serving}}</p>
                                    <p style="font-size: 16px;">Time to Prepare: {{$cookbookitem->timetoprepare}}</p>
                                    <p style="font-size: 16px;">Time to Cook: {{$cookbookitem->timetocook}}</p>

                                    <p style="font-size: 16px;">Level of Cooking: {{$cookbookitem->levelofcooking->level}}</p>
                                    <p style="font-size: 16px;">Status: {{$cookbookitem->status == 1? 'Active':'Inactive'}}</p>

                                </div>
                                <div class="col-md-6">
                                    <p style="font-size: 16px;">Course: {{$cookbookitem->course}}</p>
                                    <p style="font-size: 16px;">Cuisine: {{$cookbookitem->cuisine}}</p>
                                    <p style="font-size: 16px;">Time of Day: {{$cookbookitem->timeofday}}</p>
                                    <p style="font-size: 16px;">Recipe Type: {{$cookbookitem->recipetype->type}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 16px;">Description: {!! $cookbookitem->description !!}</p>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header h5">Steps to Cook:</div>
                            <div class="card-body">
                                {!! $cookbookitem->steps !!}
                            </div>


                        </div>

                        <div class="card mt-3">
                            <div class="card-header h5">Ingredients Section:</div>
                            <div class="card-body">


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

@endpush
