@extends('frontend.layouts.app')
@push('styles')

@endpush
@section('content')

<section class="ftco-section bg-light">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-1 order-md-last">
            </div>
            <div class="col-md-12 col-lg-10 order-md-last">
                <div class="card">
                    <div class="card-header">
                        <h4 class="billing-heading text-center mt-2 mb-2">My Orders</h4>
                    </div>
                    <div class="card-body">
                        @if ($orders->count() == 0)
                            You have no orders.
                        @else
                        <div class="table-responsive text-center">
                            <table id="myTable" class="table">
                                <thead>
                                    <tr>
                                        <th style="font-weight: bold;">Order Id</th>
                                        <th style="font-weight: bold;">Ordered Date</th>
                                        <th style="font-weight: bold;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{date('F d, Y', strtotime($order->created_at))}}</td>
                                            <td>
                                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong{{$order->id}}">View Order</a>

                                                    <div class="modal fade" id="exampleModalLong{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog" role="document" style="max-width: 900px;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Order Id -> {{$order->id}}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="table-responsive text-center ">
                                                                        <table class="table" id="myTable">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="font-weight: bold;">Product Image</th>
                                                                                    <th style="font-weight: bold;">Product Name</th>
                                                                                    <th style="font-weight: bold;">Order Status</th>
                                                                                    <th style="font-weight: bold;">Quantity</th>
                                                                                    <th style="font-weight: bold;">Unit Price</th>
                                                                                    <th style="font-weight: bold;">Total</th>
                                                                                    <th style="font-weight: bold;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @php
                                                                                    $order_id = $order->id;
                                                                                    $orderedproducts = DB::table('ordered_products')->where('order_id', $order_id)->get();
                                                                                @endphp
                                                                                @foreach ($orderedproducts as $productorder)
                                                                                <tr>
                                                                                        @php
                                                                                            $product = DB::table('products')->where('id', $productorder->product_id)->first();
                                                                                            $productimage = DB::table('product_images')->where('product_id', $product->id)->first();
                                                                                        @endphp
                                                                                        <td>
                                                                                            <img src="{{Storage::disk('uploads')->url($productimage->filename)}}" alt="" style="max-height: 100px;">
                                                                                        </td>
                                                                                        <td>
                                                                                            <b>{{$product->title}} <br>({{$product->quantity}} {{$product->unit}})</b>
                                                                                        </td>
                                                                                        <td>
                                                                                            @php
                                                                                                $status = DB::table('order_statuses')->where('id', $productorder->status_id)->first();
                                                                                            @endphp
                                                                                            {{$status->status}}
                                                                                        </td>
                                                                                        <td>{{$productorder->quantity}}</td>
                                                                                        <td>Rs. {{$productorder->price}}</td>
                                                                                        <td>
                                                                                            Rs. {{$productorder->quantity * $productorder->price}}
                                                                                        </td>

                                                                                        @if ($productorder->status_id == 1 || $productorder->status_id == 2 || $productorder->status_id == 3)
                                                                                            <td><a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#cancel{{$productorder->id}}">Cancel Order</a></td>
                                                                                        @else
                                                                                            <td>-</td>
                                                                                        @endif
                                                                                </tr>
                                                                                <div class="modal fade" id="cancel{{$productorder->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                                                    <div class="modal-dialog" role="document">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Cancel Product : Order Id ({{$order_id}}) -> {{$product->title}}</h5>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <form action="{{route('cancelorder', $productorder->id)}}" method="POST">
                                                                                                    @csrf
                                                                                                    @method('PUT')
                                                                                                    <div class="row px-5">
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <label for="reason">Pick a reason</label><br>
                                                                                                                <select name="reason">
                                                                                                                    <option value="">Select an Option suitable for your situation</option>
                                                                                                                    <option value="Cheaper alternative available for lesser price">Cheaper alternative available for lesser price</option>
                                                                                                                    <option value="Ordered out of excitement and realised it's of no need">Ordered out of excitement and realised it's of no need</option>
                                                                                                                    <option value="Not going to be available in town due to some urgent travel">Not going to be available in town due to some urgent travel</option>
                                                                                                                    <option value="Product is taking too long to be delivered">Product is taking too long to be delivered</option>

                                                                                                                </select>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-12">
                                                                                                            <div class="form-group">
                                                                                                                <br>
                                                                                                                <label for="other">Other:(If reason is not available above)</label>
                                                                                                                <textarea class="form-control" rows="3" name="other"></textarea>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row px-5">
                                                                                                        <div class="col-md-12">
                                                                                                            <button type="submit" class="btn btn-danger btn-sm mt-3">Submit & Cancel</button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary py-3 px-4" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-1 order-md-last">
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">

    function displaybox() {
            var row = document.getElementById("willappear");
            if(row.style.display === "none") {
                row.style.display = "block";
            } else {
                row.style.display = "none";
            }
        }

        function disappear() {
            var row = document.getElementById("willappear");
                row.style.display = "none";
        }
</script>

@endpush

