@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
<div class="right_col" role="main">
    <h1 class="mt-3">Create Role  <a href="{{route('role.index')}}" class="btn btn-primary btn-sm"> <i class="fa fa-plus" aria-hidden="true"></i> View Roles</a></h1>
    <div class="card mt-3">
        <div class="row">
            <div class="col-md-6">
               <form action="{{route('role.store')}}" method="POST" class="bg-light p-3">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="name">Role Name: </label>
                        <input type="text" name="name" class="form-control" value="{{@old('name')}}" placeholder="Enter Role Name">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="permission">Permissions </label><br>
                        @foreach ($permissions as $permission)
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"> {{$permission->name}} <br>
                        @endforeach
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
