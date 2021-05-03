@extends('layouts.Backend.base')
@section('title', 'Create Product')
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
                        <span style="float: left"><a href="{{ route('products.index') }}">Chi tiết phương tiện</a></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="breadcrumbs">
            <div class="pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="card-title">{{ $product->name }}</h6>
                                    <div class="card-tools">
                                        <div class="image-preview" id="imagePreview">
                                            <img class="image-preview__image" width="150px" src="{{ $product->image }}" id="img_thumbnail" alt="">
                                            <span id="store_image" class="image-preview__default-text"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h6 style="padding-left: 60px;font-size: 18px;font-weight: 700">Thông số kỹ thuật</h6>
                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Thương hiệu:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $product->brand->name }}
                                        </div>
                                    </div>

                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Khu vực đăng ký:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $product->district->name }}
                                        </div>
                                    </div>

                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Loại xe:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $product->category->name }}
                                        </div>
                                    </div>

                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Kiểu xe:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $product->range }}
                                        </div>
                                    </div>
                                    @if($product->category_id == 1)
                                    <div class="row pt-2">
                                        <div class="col-md-6">
                                            <span style="font-weight: 500">Biển số xe:</span>
                                        </div>
                                        <div class="col-md-5">
                                            {{ $product->biensoxe }}
                                        </div>
                                    </div>
                                    @else
                                    @endif
                                </div>
                            </div>

                        </div>
                        @include('partials.alert')
                        <div class="alert-danger"></div>
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
{{--                            <input type="hidden" id="partner_id" name="partner_id" value="{{ $user->id }}">--}}
                            <div class="card-body">
                                <div class="row p-3">
                                    <span class="pb-3" style="font-size: 16px;font-weight: 700">Thông số kỹ thuật:</span>
                                </div>
                                <div class="row pb-3">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="consumption">Mức Tiêu Thụ Năng Lượng:</label>
                                                    <input type="text" name="consumption"  id="consumption" class="form-control @error('consumption') is-invalid @enderror" value="{{ $product->consumption }}" readonly>
                                                    @error('consumption')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="capacity">Dung Tích Xe:</label>
                                                    <input type="text" name="capacity"  id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ $product->capacity }}" readonly/>
                                                    @error('capacity')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="gear">Hộp Số:</label>
                                                    <input type="text" name="gear"  id="gear" class="form-control @error('gear') is-invalid @enderror" value="{{ $product->gear }}" readonly>
                                                    @error('gear')
                                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="price">Giá Thuê/Ngày:</label>
                                                    <input type="text" name="price"  id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}" readonly>
                                                    @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="insurrance">Tiền Bảo Hiểm:</label>
                                                    <input type="text" name="insurrance"  id="insurrance" class="form-control @error('insurrance') is-invalid @enderror" value="{{ $product->insurrance }}" readonly>
                                                    @error('insurrance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="deposit">Tiền Đặt Cọc(Triệu):</label>
                                                    <input type="text" name="deposit"  id="deposit" class="form-control @error('deposit') is-invalid @enderror" value="{{ $product->deposit }}" readonly />
                                                    @error('deposit')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="km">Số Km Tối Đa/Ngày:</label>
                                                    <input type="text" name="km"  id="km" class="form-control @error('km') is-invalid @enderror" value="{{ $product->km }}" readonly/>
                                                    @error('km')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="additional">Tiền phụ trội(Khi vượt quá Km):</label>
                                                    <input type="text" name="additional"  id="additional" class="form-control @error('additional') is-invalid @enderror" value="{{ $product->additional }}" readonly>
                                                    @error('additional')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="seat">Chỗ Ngồi:</label>
                                                    <input type="text" name="seat"  id="seat" class="form-control @error('seat') is-invalid @enderror" value="{{ $product->seat }}" readonly>
                                                    @error('seat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr width="100%">
                                <div class="row p-3">
                                    <span style="font-size: 16px;font-weight: 700">Ảnh phương tiện:</span>
                                </div>
                                <div class="row ">
                                    @foreach($galaxies as $galaxy)
                                    <div class="col-3">
                                        <div class="thumbnail">
                                            <a href="#">
                                                <div style="height: 120px;width: 150px">
                                                    <img src="{{ $galaxy->image }}" alt="" style="width:100%">
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('products.index') }}" class="btn btn-primary"><i class="fas fa-save"></i> Danh sách đối tác</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /#right-panel -->

@endsection

