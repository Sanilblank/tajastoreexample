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

    <h1 class="mt-3">Orders by {{$customer->name}}  <a href="{{ route('cancelledproduct.index') }}" class="btn btn-primary btn-sm"> <i
        class="fa fa-eye" aria-hidden="true"></i> Cancelled Orders</a></h1>
    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered yajra-datatable text-center">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Order Id</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Product info</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Ordered Date</th>
                        <th class="text-center">Status</th>
                        {{-- <th class="text-center">Action</th> --}}
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
    $(function () {

      var table = $('.yajra-datatable').DataTable({

          processing: true,
          serverSide: true,
          ajax: "{{ route('cancelledproduct.show', $cancelledorder->id) }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'order_id', name: 'order_id'},
              {data: 'image', name: 'image'},
              {data: 'info', name: 'info'},
              {data: 'quantity', name: 'quantity'},
              {data: 'price', name: 'price'},
              {data: 'date', name: 'date'},
              {data: 'status', name: 'status'},
            //   {
            //       data: 'action',
            //       name: 'action',
            //       orderable: true,
            //       searchable: true
            //   },
          ]
      });

    });
  </script>
@endpush
