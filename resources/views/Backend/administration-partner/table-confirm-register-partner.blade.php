@extends('layouts.Backend.base')
@section('title', 'Confirm Partner')
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
                        <span style="float: left"><a href="{{ route('pages.confirmpartner') }}">Danh sách đăng ký đối tác</a></span>
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
                                            <a href="#" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Danh sách đăng ký</a>
                                        </div>
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Địa Chỉ</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>Action</th>
                                        <th>Xóa</th>
                                        <th>Ngày gửi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $index = $partners->perPage()*($partners->currentPage() - 1);
                                    @endphp
                                    @foreach($partners as $partner)
                                        <tr>
                                            <td>
                                                @php
                                                    $index++;
                                                @endphp
                                                {{ $index }}
                                            </td>
                                            <td>{{ $partner->name }}</td>
                                            <td>{{ $partner->email }}</td>
                                            <td>{{ $partner->address }}</td>
                                            <td>{{ $partner->phone }}</td>
                                            <td>{{ $partner->title }}</td>
                                            <td>{{ $partner->note }}</td>
                                            <td>
                                                @if($partner->status == "outofstock")
                                                    <a href="{{ route('dashboards.confirmlock', $partner->id) }}" class="badge badge-warning">Create</a>
                                                @else
                                                    <span class="badge badge-success">Success</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('dashboards.deleteconfirmpartner') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="partner_id" id="partner_id" value="{{ $partner->id }}">
                                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                </form>
                                            </td>
                                            <td>{{ $partner->created_at }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $partners->render('pagination::bootstrap-4') !!}
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




