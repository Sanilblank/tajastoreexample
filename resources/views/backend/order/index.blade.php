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

    <h1 class="mt-3">Our Orders <a href="{{route('order.create')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> Register New Order</a></h1>
    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered yajra-datatable text-center">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Order Id</th>
                        <th class="text-center">Customer</th>
                        <th class="text-center">Delievery Address</th>
                        <th class="text-center">Contact no.</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Ordered Date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
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
          ajax: "{{ route('order.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'id', name: 'id'},
              {data: 'customer', name: 'customer'},
              {data: 'address', name: 'address'},
              {data: 'phone', name: 'phone'},
              {data: 'email', name: 'email'},
              {data: 'date', name: 'date'},
              {data: 'status', name: 'status'},
              {
                  data: 'action',
                  name: 'action',
                  orderable: true,
                  searchable: true
              },
          ]
      });

    });
  </script>
@endpush
