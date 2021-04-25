@extends('layouts.Backend.base')
@section('title', 'Danh sách xe đối tác')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Danh sách xe</a></span>
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
                                                <div class="col-md-6 pt-3">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 style="font-weight: 700">Tên đối tác:</h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span style="color: lightseagreen;font-size: 16px">{{ $user->name }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h6 style="font-weight: 700">Email:</h6>
                                                        </div>
                                                        <div class="col-md-6">
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
                            <div class="card-body table-responsive p-0">
                                @include('partials.alert')
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ảnh</th>
                                        <th>Tên phương tiện</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Hãng</th>
                                        <th>Danh mục</th>
                                        <th>Quận</th>
                                        <th>Chi tiết</th>
                                        <th>Xóa</th>
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
                                            <td><img width="150" src="{{ $product->image }}" alt=""></td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                {{ $product->price }}
                                            </td>
                                            <td>
                                                @if($product->featured == 0)
                                                    <a href=" {{ route('dashboards.unlockfeaturedproduct',$product->id) }}"><span class="badge badge-success">đang hoạt động</span></a>
                                                @else
                                                    <a href="{{ route('dashboards.locksfeaturedproduct', $product->id) }}"><span class="badge badge-danger">Tạm khóa</span></a>
                                                @endif
                                            </td>
                                            <td>{{ $product->brand->name }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->district->name }}</td>
                                            <td>
                                                <a href="/dashboards/show-products/{{ $product->id }}"><span class="btn btn-sm btn-info"><i class="fa fa-eye"></i>&nbsp;Chi tiết</span></a>
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





