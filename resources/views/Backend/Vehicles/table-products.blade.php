@extends('layouts.Backend.base')
@section('title', 'Danh Sách Phương Tiện')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Danh sách đối tác</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.tableproducts', $user->id) }}">Danh Sách Phương Tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-10 offset-1">
                    <div>
                        <div class="card">
                            <div class="card-header ui-sortable-handle" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-tools">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h3 style="font-size: 20px;font-weight: 700">THÔNG TIN CƠ BẢN</h3>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 pt-3">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 style="font-weight: 700">Tên đối tác:</h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <span style="color: lightseagreen;font-size: 16px">{{ $user->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 style="font-weight: 700">Email:</h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <span style="color: lightseagreen;font-size: 16px">{{ $user->email }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 style="font-weight: 700">Số điện thoại:</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span style="color: lightseagreen;font-size: 16px">{{ $user->phone }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 style="font-weight: 700">Địa chỉ:</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span style="color: lightseagreen;font-size: 16px">{{ $user->address }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-2 " style="text-align: right">
                                                    <div class="image-preview_p" id="imagePreview">
                                                        <img class="image-preview__image" width="100px" src="{{ $user->profile_photo_path }}" id="img_thumbnail" alt="">
                                                        <span id="store_image" class="image-preview__default-text"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table table-hover text-nowrap" id="product_table" >
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Ảnh</th>
                                            <th>Tên phương tiện</th>
                                            <th>Trạng thái</th>
                                            <th>Confirm</th>
                                            <th>Danh mục</th>
                                            <th>Chi tiết</th>
                                            <th>Xóa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td><img width="150" src="{{ $product->image }}" alt=""></td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                @if($product->featured == 0)
                                                    <a href=" {{ route('dashboards.unlockfeaturedproduct',$product->id) }}"><span class="badge badge-warning">đang hoạt động</span></a>
                                                @else
                                                    <a href="{{ route('dashboards.locksfeaturedproduct', $product->id) }}"><span class="badge badge-danger">Tạm khóa</span></a>
                                                @endif
                                            </td>
                                            <td>
                                                @if($product->confirm == 0)
                                                    <span class="badge badge-secondary">Offline</span>
                                                @elseif($product->confirm == 1)
                                                    <span class="badge badge-success">Online</span>
                                                @else
                                                    <span class="badge badge-primary">Đã nhận chuyến</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                <a href="/dashboards/show-products/{{ $product->id }}"><span class="btn btn-sm btn-light"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
                                            </td>
                                            <td>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-sm btn-primary" href="{{ route('products.index') }}">Quay lại</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-1 pb-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Trạng Thái: Sử dụng khi Admin muốn bật(<span class="badge badge-warning">Đang hoạt động</span>) hoặc ẩn(<span class="badge badge-danger">Tạm khóa</span>) phương tiện.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Confirm: Sư dụng khi chủ xe muốn bật(<span class="badge badge-success">Online</span>) hoặc tắt(<span class="badge badge-secondary">Offline</span>) nhận chuyến.
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>

{{--        <div class="breadcrumbs pt-3 pb-3">--}}

{{--        </div>--}}
    </div><!-- /#right-panel -->

@endsection
@section('addjs')
    <script type="text/javascript">
        jQuery(document).ready( function () {
            jQuery('#product_table').DataTable({
                "language": {
                    "lengthMenu": "Hiển thị _MENU_ bản ghi 1 trang",
                    "zeroRecords": "Không có bản ghi - sorry",
                    "info": "Trang số _PAGE_ trên tổng số _PAGES_",
                    "infoEmpty": "Không có dữ liệu",
                    "infoFiltered": "(Lọc từ _MAX_ bản ghi)",
                    "paginate": {
                        "first": "Đầu tiên",
                        "last": "Cuối cùng",
                        "next": "Sau",
                        "previous": "Trước"
                    },
                    "search": "Tìm kiếm:",
                }
            });
        } );
        jQuery(document).ready(function () {
            jQuery('.dataTables_filter input[type="search"]').css(
                {'width':'400px','display':'inline-block'}
            );
        });
    </script>
@endsection




