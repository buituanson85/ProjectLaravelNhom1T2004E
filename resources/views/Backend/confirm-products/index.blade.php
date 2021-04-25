@extends('layouts.Backend.base')
@section('title', 'Xác nhận đăng ký phương tiện')
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
                        <span style="float: left"><a href="{{ route('dashboards.confirmproduct') }}">Danh sách đăng ký</a></span>
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
{{--                                            <a href="{{ route('partners.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Product</a>--}}
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        {{--                                        <form action="{{ route('partners.index') }}" class="form-horizontal">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            <div class="row">--}}
                                        {{--                                                <div class="col-md-12">--}}
                                        {{--                                                    <div class="form-group">--}}
                                        {{--                                                        <div class="col-md-12">--}}
                                        {{--                                                            <div class="row">--}}
                                        {{--                                                                <div class="col-md-9">--}}
                                        {{--                                                                    <input type="text" name="name" id="name" value="" placeholder="Users Name" class="form-control input-md">--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                                <div class="col-md-3">--}}
                                        {{--                                                                    <button type="submit" class="btn btn-primary">Search</button>--}}
                                        {{--                                                                </div>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ảnh</th>
                                        <th>Tên phương tiện</th>
                                        <th>Trạng thái</th>
                                        <th>Hãng phương tiện</th>
                                        <th>Danh mục</th>
                                        <th>Chi tiết</th>
                                        <th>Ngày gửi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $products->perPage()*($products->currentPage() - 1);
                                    @endphp
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td><img width="120" src="{{ $product->image }}" alt=""></td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if($product->status == "pending")
                                                    <a class="badge badge-warning">Chờ xác nhận</a>
                                                @endif
                                            </td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboards.showconfirm', $product->id) }}" class="btn btn-sm btn-primary"><span ><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
                                            </td>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $products->render('pagination::bootstrap-4') !!}
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






