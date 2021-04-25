@extends('layouts.Backend.base')
@section('title', 'Edit Galaxy')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left">Dashboard</span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="#">Create Galaxy</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card-tools">
                                            Edit Image:
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                @include('partials.alert')
                                <form action="{{ route('galaxy.update',$galaxy->id) }}" enctype="multipart/form-data" method="post" class="my-5">
                                    <div class="card-body">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <input type="file" name="image" id="image" class="input-file @error('image') is-invalid @enderror" value="{{ old('image') }}" alt="abc">
                                            <div class="image-preview" id="imagePreview">
                                                <img class="image-preview__image" width="150px" src="{{ $galaxy->image }}" id="img_thumbnail" alt="">
                                                <span id="store_image" class="image-preview__default-text"></span>
                                            </div>
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>
    </div><!-- /#right-panel -->

@endsection
