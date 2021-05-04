@extends('layouts.Backend.base')
@section('title', 'Khách hàng')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Danh sách khách hàng</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div id="app" class="pt-5">
                <div class="col-md-12">
                    <div>
                        <div class="card">
                            <div class="card-header" style="cursor: move">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{ route('products.index') }}" class="form-horizontal">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="name" id="name" value="" placeholder="Tên khách hàng" class="form-control input-md">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tên</th>
                                        <th>utype</th>
{{--                                        <th>Trạng thái</th>--}}
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Chi tiết</th>
                                        <th>Ngày đăng</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $users->perPage()*($users->currentPage() - 1);
                                    @endphp
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <span class="badge badge-secondary">{{ $user->utype }}</span>
                                            </td>
{{--                                            <td>--}}
{{--                                                @if($user->status == 'instock')--}}
{{--                                                    <a href="{{ route('dashboards.doitaclock', $user->id) }}" class="badge badge-warning">Đang hoạt động</a>--}}
{{--                                                @else--}}
{{--                                                    <a href="{{ route('dashboards.doitacunlock', $user->id) }}" class="badge badge-danger">Tạm khóa</a>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->address }}</td>
                                            <td>
                                                <a href="{{ route('customers.show', $user->id) }}"><span class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
                                            </td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <form action="{{ route('products.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $users->render('pagination::bootstrap-4') !!}
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





