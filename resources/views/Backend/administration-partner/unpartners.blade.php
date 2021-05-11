@extends('layouts.Backend.base')
@section('title', 'Danh sách phương tiện')
@section('content')
    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.unpartners') }}">Danh Sách Phương Tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-12">
                    <div class="p-0">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="card-title" style="font-size: 20px;font-weight: 700">Danh sách phương tiện(Chờ xác nhận hồ sơ)</h3>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('partners.create') }}" class="btn btn-primary pull-right"><i class="fas fa-plus-circle"></i> Đăng ký phương tiện</a>
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
                                        <th>Tên</th>
                                        <th>Trạng thái</th>
                                        <th>Confirm</th>
                                        <th>Danh mục</th>
                                        <th>Cập nhật</th>
                                        <th>Hồ sơ</th>
                                        <th>Chi tiết hồ sơ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = 0;
                                    @endphp
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ ++$index }}</td>
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
                                            <td>{{ $product->category->name }}</td>
                                            <td>
                                                <a href="{{ route('dashboards.editunphuongtien', $product->id ) }}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Cập nhật</span></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('dashboards.galaxys', $product->id ) }}"><span class="btn btn-sm btn-info"><i class="far fa-folder"></i>&nbsp;Hồ sơ</span></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.acceptProduct', $product->id ) }}" class="btn btn-sm btn-light"><span ><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-1 pb-5">
                    <h3 style="font-weight: 700">GHI CHÚ:</h3>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Đăng ký phương tiện: sau khi chủ điền đầy đủ thông tin + upload hồ sơ(ở mục hồ sơ) -> <span class="badge badge-secondary">đợi hoàn thiện hồ sơ</span>.
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Chi tiết:<br>
                            <span class="pl-3">+ Chủ phương tiện vào mục chi tiết để gửi hồ sơ lên hệ thống sau khi gửi hồ sơ sẽ chuyển sang trạng thái(<span class="badge badge-warning">Đợi phản hồi</span>) Admin sẽ xem sét hồ sơ sẽ duyệt nếu hồ sơ hợp lệ hồ sơ chuyển sang trạng thái(<span class="badge btn-primary">Sẵn Sàng</span>)</span>Lúc này phương tiện có thể nhận chuyến<br>
                            <span class="pl-3">+ Trường hợp hồ sơ không hợp lệ Admin sẽ từ chối(<span class="badge badge-danger">Bị từ chối hồ sơ</span>) trả hồ sơ về cho chủ phương tiện để cập nhật lại thông tin phương tiện</span><br>
                            <span class="pl-3">+ Trong quá đợi Amin sét duyệt nếu chủ phương tiện không muốn đăng ký phương tiện này nữa có thể rút hồ sơ về.</span>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Confirm: Chủ phương tiện có thể bật khả năng nhận chuyến(<span class="badge badge-success">Online</span>) hoặc không muốn nhận chuyến(<span class="badge badge-secondary">Offline</span>).
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-md-12">
                            - Cập nhật: Chủ phương tiện sau khi cập nhật lại thông tin phương tiện cần yêu cầu Admin sét duyệt lại phương tiện mới có thể nhận chuyến(<span class="badge badge-secondary">đợi hoàn thiện hồ sơ</span>).
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}"></script>
        </div>


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





