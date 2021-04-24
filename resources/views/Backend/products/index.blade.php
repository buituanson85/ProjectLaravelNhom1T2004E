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
                        <span style="float: left">Dashboard</span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ URL::to('/dashboards/products') }}">Phương tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                        <div class="card-header">

                            <h3 class="card-title">Danh sách phương tiện</h3>

                            <div class="card-tools">
                                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>Thêm phương tiện mới</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-6">
                            @include('partials.alert')
                            <table class="table table-hover text-nowrap" id="product_table" >
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên phương tiện</th>
                                    <th>Hình ảnh</th>
                                    <th>Giá</th>
                                    <th>Đặt cọc</th>
                                    <th>Chi tiết</th>
                                    <th>Chỉnh sửa</th>
                                    <th>Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $index = 0;
                                @endphp
                                @forelse ($products as $product )
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ $product->image }}"></img></td>
                                        <td>{{number_format($product->price,0) }}</td>
                                        <td>{{ number_format($product->deposit,0) }}</td>
                                        <td><a href="{{route('product.show', $product->id)}}"><span class="btn btn-sm btn-success"><i class="fa fa-edit"></i>&nbsp;Chi tiết</span></a></td>
                                        <td>
{{--                                            @if($product->name === "Admin")--}}

{{--                                            @else--}}
                                                <a href="{{route('product.edit', $product->id)}}"><span class="btn btn-sm btn-warning"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</span></a>
{{--                                            @endif--}}
                                        </td>
                                        <td>
{{--                                            @if($role->name === "Admin")--}}

{{--                                            @else--}}
                                                <form action="{{route('product.destroy', $product->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                                </form>
{{--                                            @endif--}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td><i class="fas fa-folder-open"></i> No Record found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                        "first":      "Đầu tiên",
                        "last":       "Cuối cùng",
                        "next":       "Sau",
                        "previous":   "Trước"
                    },
                    "search":         "Tìm kiếm:",
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

