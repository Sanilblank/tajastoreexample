@extends('backend.layouts.app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
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

        <h1 class="mt-3">Settings</h1>
        <div class="card mt-3">
            <div class="card-body">
                <form action="{{route('setting.update', $setting->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tab_1" role="tab"
                                    aria-selected="true">Site Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_2" role="tab"
                                    aria-selected="false">Social Media</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_3" role="tab"
                                    aria-selected="false">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tab_4" role="tab"
                                    aria-selected="false">Address</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5">
                            <div class="tab-pane active" id="tab_1">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="site address">Site Address</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="sitename" class="form-control"
                                                value="{{ $setting->sitename }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="headerImage">Select a Header Image</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" name="headerImage" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="currentimage">Current Header Image</label>
                                            <img src="{{ Storage::disk('uploads')->url($setting->headerImage) }}"
                                                style='max-width: 100px;'>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="footerImage">Select a Footer Image</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" name="footerImage" class="form-control">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="currentlogo">Current Footer Image</label>
                                            <img src="{{ Storage::disk('uploads')->url($setting->footerImage) }}"
                                                style='max-width: 100px;'>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_2">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="facebook">Facebook</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="facebook" class="form-control"
                                                value="{{ $setting->facebook }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="linkedin">Linkedin</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="linkedin" class="form-control"
                                                value="{{ $setting->linkedin }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="youtube">Youtube</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="youtube" class="form-control"
                                                value="{{ $setting->youtube }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="instagram">Instagram</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="instagram" class="form-control"
                                                value="{{ $setting->instagram }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_3">
                                <div class="form-group">
                                    <textarea name="aboutus"
                                        id="summernote">{{ $setting->aboutus }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_4">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="address">Address</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $setting->address }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="phone">Phone No</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $setting->phone }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="email" class="form-control"
                                                value="{{ $setting->email }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Save</button>

                </form>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['height', ['height']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
        });

    </script>
@endpush
