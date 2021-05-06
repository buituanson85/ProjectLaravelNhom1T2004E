@extends('layouts.Backend.base')
@section('title', 'Hồ sơ phương tiện')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-md-10">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('partners.index') }}">Danh Sách Phương Tiện</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.galaxys', $product->id ) }}">Thêm Hồ sơ</a></span>
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
                                    <div class="col-md-12">
                                        <div class="card-tools">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    Upload Ảnh:
                                                </div>
                                                <div class="col-md-8" style="text-align: right">
                                                    @if($product->status == "ready")
                                                        <a href="{{ route('partners.index') }}"  style="margin: 5px" class="btn btn-primary">Về danh sách phương tiện</a>
                                                    @else
                                                        <a href="{{ route('dashboards.unpartners') }}"  style="margin: 5px" class="btn btn-primary">Về danh sách phương tiện</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                @include('partials.alert')
                                <form action="" enctype="multipart/form-data" method="post" class="my-5">
                                    <div class="card-body">
                                        @csrf
                                        <div class="form-group">
                                            <label for="images">Chọn nhiều ảnh:</label>
                                            <input  type="file" class="form-control" id="images" name="images[]" multiple>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
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

        <div class="breadcrumbs">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heard" style="padding: 30px 0 20px 0">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="pl-3 text-uppercase font-14">Table Galaxy</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            @include('partials.alert')
                            <table class="table table-hover data-table">
                                <thead>
                                <tr>
                                    <th width="20%">No</th>
                                    <th width="30%">Product</th>
                                    <th width="10%">Edit</th>
                                    <th width="10%">Destroy</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($galaxys as $galaxy)
                                    <tr>
                                        <td><img src="{{ $galaxy->image }}" width="100" alt=""></td>
                                        <td>{{ $galaxy->product->name }}</td>
                                        <td>
                                            <a href="{{ route('galaxy.edit', $galaxy->id) }}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Edit</span></a>
                                        </td>
                                        <td>
                                            <a href="/dashboards/product/deletegalaxys/{{ $galaxy->id }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $galaxys -> links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#right-panel -->

@endsection






















