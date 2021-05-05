@extends('backend.layouts.app')
@push('styles')

@endpush
@section('content')
    <div class="right_col" role="main">
        <h1 class="mt-3">Create Users <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm"> <i
                    class="fa fa-plus" aria-hidden="true"></i> View Users</a></h1>
        <div class="card mt-3">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('user.store') }}" method="POST" class="bg-light p-3">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="name">Full Name: </label>
                            <input type="text" name="name" class="form-control" value="{{ @old('name') }}"
                                placeholder="Enter Full Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="text" name="email" class="form-control" value="{{ @old('email') }}"
                                placeholder="E-mail Address">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" name="role_id" id="role">
                                <option value="">--Select a role--</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" name="password" class="form-control" value="{{ @old('password') }}"
                                placeholder="Password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirmpassword">Confirm Password: </label>
                            <input type="password" name="password_confirmation" class="form-control"
                                value="{{ @old('password_confirmation') }}" placeholder="Re-Enter Password">
                            @error('password_confirmation')
                                <p class="text-danger">{{ $message }}</p>
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
