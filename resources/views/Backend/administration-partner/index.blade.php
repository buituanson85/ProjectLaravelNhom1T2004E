@extends('layouts.Backend.base')
@section('title', 'Partner')
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
                        <span style="float: left"><a href="{{ route('partners.index') }}">Danh sách phương tiện</a></span>
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
                                            <a href="{{ route('partners.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Đăng ký xe</a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
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
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th>Confirm</th>
                                        <th>Hãng xe</th>
                                        <th>Danh mục</th>
                                        <th>Hồ sơ</th>
                                        <th>Chi tiết hồ sơ</th>
                                        <th>Ngày đăng</th>
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
                                                @if($product->status == "unavailable")
                                                    <span class="badge badge-secondary">Đợi hoàn thiện hồ sơ</span>
                                                @elseif($product->status == "pending")
                                                    <span class="badge badge-warning">Đợi phản hồi</span>
                                                @elseif($product->status == "ready" || $product->status == "unready")
                                                    <span class="badge badge-primary">Sẵn sàng</span>
                                                @else
                                                    <span class="badge badge-danger">Bị từ chối hồ sơ</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->status == "ready" || $product->status == "unready")
                                                    @if($product->confirm == 0)
                                                        <a href="{{ route('dashboards.lockstatustpartner', $product->id) }}"><span class="badge badge-secondary">Offline</span></a>
                                                    @elseif($product->confirm == 1)
                                                        <a href="{{ route('dashboards.unlockstatustpartner', $product->id) }}"><span class="badge badge-success">Online</span></a>
                                                    @else
                                                        <span class="badge badge-primary">Đã nhận chuyến</span>
                                                    @endif
                                                @else

                                                @endif
                                            </td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboards.galaxys', $product->id ) }}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Hồ sơ</span></a>
                                                {{--                                                <a href="/dashboards/table-products/{{ $product->id }}"><span class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>&nbsp;View</span></a>--}}
                                            </td>
                                            <td>
                                                <a href="{{ route('product.acceptProduct', $product->id ) }}" class="btn btn-sm btn-primary"><span ><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
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





