@extends('backend.layouts.app')
@push('styles')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="right_col" role="main">
        <!-- MAIN -->
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

        <h1 class="mt-3">User Cart Products => {{$user->name}} <a href="{{ route('cartproduct.index') }}" class="btn btn-primary btn-sm"> <i
            class="fa fa-eye" aria-hidden="true"></i> Back to Active Users</a></h1>
        <div class="card mt-3">
            <div class="card-body table-responsive">
                <table class="table table-bordered yajra-datatable text-center">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Subcategory</th>
                            <th class="text-center">Bought Price</th>
                            <th class="text-center">Selling Price</th>
                            <th class="text-center">Discount</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">No in Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {

            var table = $('.yajra-datatable').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('cartproduct.show', $user->id) }}",
                columns: [{data: 'DT_RowIndex',name: 'DT_RowIndex'},
                        {data: 'image', name: 'image'},
                        {data: 'name', name: 'name'},
                        {data: 'subcategory', name: 'subcategory'},
                        {data: 'costprice', name: 'costprice'},
                        {data: 'sellingprice', name: 'sellingprice'},
                        {data: 'discount', name: 'discount'},
                        {data: 'quantity', name: 'quantity'},
                        {data: 'stock', name: 'stock'},
                ]
            });

        });

    </script>
@endpush
