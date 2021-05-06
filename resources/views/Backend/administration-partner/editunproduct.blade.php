@extends('layouts.Backend.base')
@section('title', 'Chỉnh sửa phương tiện')
@section('content')

    <div id="right-panel" class="right-panel">

        <!-- Header-->
    @include('layouts.Backend.header')
    <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-8">
                <div class="page-header float-left">
                    <div class="page-title" style="margin-top: 10px">
                        <span style="float: left"><a href="{{ route('dashboard.index') }}">Dashboard</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('partners.index') }}">Danh Sách Phương Tiện</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('dashboards.editunphuongtien', $product->id) }}">Chỉnh Sửa Phương Tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Chỉnh sửa phương tiện của bạn</h3>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('partners.index') }}" class="btn btn-sm btn-danger pull-right"><i class="fas fa-shield-alt"></i>Xem tất cả phương tiện của bạn</a>
                                </div>
                            </div>
                        </div>
                        <div class="alert-danger"></div>
                        <form class="form-group pt-3" method="POST" action="{{ route('dashboards.updateunphuongtien', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Tên phương tiện:</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Loại xe:</label>
                                            <div class="col-md-9">
                                                <select type="number" name="category_id"  id="category_id" class="form-control @error('category_id') is-invalid @enderror" value="{{ old('category_id') }}">
                                                    <option value="">Chọn loại xe</option>
                                                    @foreach($categories as $category)
                                                        @if($category->id== $product->category_id)
                                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                        @else
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Thương hiệu:</label>
                                            <div class="col-md-9">
                                                <select type="number" name="brand_id"  id="brand_id" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                                    <option value="">Chọn thương hiệu xe</option>

                                                    @foreach($brands as $brand)
                                                        @if($brand->id== $product->brand_id)
                                                            <option value="{{$brand->id}}" selected>{{$brand->name}}</option>
                                                        @else
                                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('brand_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Hình ảnh:</label>
                                            <div class="col-md-9">
                                                <input type="file" name="image"  id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                {{--                                                @if(isset($product->image))--}}
                                                <img src="{{$product->image}}" alt="" style="width: 200px">
                                                {{--                                                @endif--}}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Giá thuê theo ngày (VNĐ):</label>
                                            <div class="col-md-9">
                                                <input type="number" name="price"  id="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">
                                                @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Giá trị bảo hiểm cho phương tiện:</label>
                                            <div class="col-md-9">
                                                <input type="number" name="insurance"  id="insurance" class="form-control @error('insurance') is-invalid @enderror" value="{{$product->insurrance}}">
                                                @error('insurance')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Số tiền đặt cọc tối thiểu (VNĐ):</label>
                                            <div class="col-md-9">
                                                <input type="number" name="deposit"  id="deposit" class="form-control @error('deposit') is-invalid @enderror" value="{{$product->deposit}}">
                                                @error('deposit')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Quãng đường tối đa cho phép thuê (km): </label>
                                            <div class="col-md-9">
                                                <input type="number" name="km"  id="km" class="form-control @error('km') is-invalid @enderror" value="{{$product->km}}">
                                                @error('km')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Giá phát sinh cho quãng đường phụ trội:</label>
                                            <div class="col-md-9">
                                                <input type="number" name="additional"  id="additional" class="form-control @error('additional') is-invalid @enderror" value="{{$product->additional}}">
                                                @error('additional')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Động cơ xe:</label>
                                            <div class="col-md-9">
                                                <select name="engine"  id="engine" class="form-control @error('engine') is-invalid @enderror" value="{{ old('engine') }}">
                                                    <option value="">Chọn loại động cơ</option>
                                                    @if($product->engine == "Xăng")
                                                        <option selected value="Xăng">Xăng</option>
                                                        <option value="Dầu">Dầu</option>
                                                        <option value="Điện">Điện</option>
                                                    @elseif($product->engine == "Dầu")
                                                        <option value="Xăng">Xăng</option>
                                                        <option selected value="Dầu">Dầu</option>
                                                        <option value="Điện">Điện</option>
                                                    @else
                                                        <option value="Xăng">Xăng</option>
                                                        <option value="Dầu">Dầu</option>
                                                        <option selected value="Điện">Điện</option>
                                                    @endif

                                                </select>
                                                @error('engine')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Số ghế:</label>
                                            <div class="col-md-9">
                                                <select type="number" name="seat"  id="seat" class="form-control @error('seat') is-invalid @enderror" value="{{ old('seat') }}">
                                                    <option value="">Chọn số lượng ghế</option>
                                                    @if($product->seat == "Xe máy")
                                                        <option selected value="Xe máy">Xe máy</option>
                                                        <option value="4 Chỗ">4 Chỗ</option>
                                                        <option value="7 Chỗ">7 Chỗ</option>
                                                        <option value="Bán Tải">Bán Tải</option>
                                                        <option value="Xe Sang">Xe Sang</option>
                                                    @elseif($product->seat == "4 Chỗ")
                                                        <option value="Xe máy">Xe máy</option>
                                                        <option selected value="4 Chỗ">4 Chỗ</option>
                                                        <option value="7 Chỗ">7 Chỗ</option>
                                                        <option value="Bán Tải">Bán Tải</option>
                                                        <option value="Xe Sang">Xe Sang</option>
                                                    @elseif($product->seat == "7 Chỗ")
                                                        <option value="Xe máy">Xe máy</option>
                                                        <option value="4 Chỗ">4 Chỗ</option>
                                                        <option selected value="7 Chỗ">7 Chỗ</option>
                                                        <option value="Bán Tải">Bán Tải</option>
                                                        <option value="Xe Sang">Xe Sang</option>
                                                    @elseif($product->seat == "Xe Sang")
                                                        <option value="Xe máy">Xe máy</option>
                                                        <option value="4 Chỗ">4 Chỗ</option>
                                                        <option value="7 Chỗ">7 Chỗ</option>
                                                        <option value="Bán Tải">Bán Tải</option>
                                                        <option selected value="Xe Sang">Xe Sang</option>
                                                    @else
                                                        <option value="Xe máy">Xe máy</option>
                                                        <option value="4 Chỗ">4 Chỗ</option>
                                                        <option value="7 Chỗ">7 Chỗ</option>
                                                        <option selected value="Bán Tải">Bán Tải</option>
                                                        <option value="Xe Sang">Xe Sang</option>
                                                    @endif
                                                </select>
                                                @error('seat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Công suất động cơ (CC/HP):</label>
                                            <div class="col-md-9">
                                                <input type="text" name="capacity"  id="seat" class="form-control @error('capacity') is-invalid @enderror" value="{{$product->capacity}}" placeholder="Nhập số công suất tính theo CC hoặc mã lực (HP) (ví dụ: 110CC, 200HP,...)">
                                                @error('capacity')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Kiểu loại phương tiện:</label>
                                            <div class="col-md-9">
                                                <select type="text" name="range"  id="range" class="form-control @error('range') is-invalid @enderror" value="{{ old('range') }}">
                                                    <option value="">Chọn kiểu phương tiện</option>
                                                    @if($product->range == "Sedan")
                                                        <option selected value="Sedan">Sedan</option>
                                                        <option value="Coupe">Coupe</option>
                                                        <option value="Sport">Sport</option>
                                                        <option value="Hatchback">Hatchback</option>
                                                        <option value="Minivan">Minivan</option>
                                                        <option value="Fashion">Fashion</option>
                                                    @elseif($product->range == "Coupe")
                                                        <option value="Sedan">Sedan</option>
                                                        <option selected value="Coupe">Coupe</option>
                                                        <option value="Sport">Sport</option>
                                                        <option value="Hatchback">Hatchback</option>
                                                        <option value="Minivan">Minivan</option>
                                                        <option value="Fashion">Fashion</option>
                                                    @elseif($product->range == "Sport")
                                                        <option value="Sedan">Sedan</option>
                                                        <option value="Coupe">Coupe</option>
                                                        <option selected value="Sport">Sport</option>
                                                        <option value="Hatchback">Hatchback</option>
                                                        <option value="Minivan">Minivan</option>
                                                        <option value="Fashion">Fashion</option>
                                                    @elseif($product->range == "Hatchback")
                                                        <option value="Sedan">Sedan</option>
                                                        <option value="Coupe">Coupe</option>
                                                        <option value="Sport">Sport</option>
                                                        <option selected value="Hatchback">Hatchback</option>
                                                        <option value="Minivan">Minivan</option>
                                                        <option value="Fashion">Fashion</option>
                                                    @elseif($product->range == "Minivan")
                                                        <option value="Sedan">Sedan</option>
                                                        <option value="Coupe">Coupe</option>
                                                        <option value="Sport">Sport</option>
                                                        <option value="Hatchback">Hatchback</option>
                                                        <option selected value="Minivan">Minivan</option>
                                                        <option value="Fashion">Fashion</option>
                                                    @else
                                                        <option value="Sedan">Sedan</option>
                                                        <option value="Coupe">Coupe</option>
                                                        <option value="Sport">Sport</option>
                                                        <option value="Hatchback">Hatchback</option>
                                                        <option value="Minivan">Minivan</option>
                                                        <option selected value="Fashion">Fashion</option>
                                                    @endif
                                                </select>
                                                @error('range')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Loại động cơ:</label>
                                            <div class="col-md-9">
                                                <select type="text" name="gear"  id="gear" class="form-control @error('gear') is-invalid @enderror" value="{{ old('gear') }}">
                                                    <option value="">Chọn loại động cơ xe</option>
                                                    @if($product->gear == "Số sàn")
                                                        <option selected value="Số sàn">Số sàn</option>
                                                        <option value="Số tự động">Số tự động</option>
                                                        <option value="Xe số">Xe số</option>
                                                        <option value="Xe tay ga">Xe tay ga</option>
                                                        <option value="Xe côn">Xe côn</option>
                                                        <option value="Xe máy điện">Xe máy điện</option>
                                                    @elseif($product->gear == "Số tự động")
                                                        <option  value="Số sàn">Số sàn</option>
                                                        <option selected value="Số tự động">Số tự động</option>
                                                        <option value="Xe số">Xe số</option>
                                                        <option value="Xe tay ga">Xe tay ga</option>
                                                        <option value="Xe côn">Xe côn</option>
                                                        <option value="Xe máy điện">Xe máy điện</option>
                                                    @elseif($product->gear == "Số tự động")
                                                        <option value="Xe số">Số sàn</option>
                                                        <option value="Số tự động">Số tự động</option>
                                                        <option selected value="Xe số">Xe số</option>
                                                        <option value="Xe tay ga">Xe tay ga</option>
                                                        <option value="Xe côn">Xe côn</option>
                                                        <option value="Xe máy điện">Xe máy điện</option>
                                                    @elseif($product->gear == "Xe tay ga")
                                                        <option value="Số sàn">Số sàn</option>
                                                        <option value="Số tự động">Số tự động</option>
                                                        <option value="Xe số">Xe số</option>
                                                        <option selected value="Xe tay ga">Xe tay ga</option>
                                                        <option value="Xe côn">Xe côn</option>
                                                        <option value="Xe máy điện">Xe máy điện</option>
                                                    @elseif($product->gear == "Xe côn")
                                                        <option value="Số sàn">Số sàn</option>
                                                        <option value="Số tự động">Số tự động</option>
                                                        <option value="Xe số">Xe số</option>
                                                        <option value="Xe tay ga">Xe tay ga</option>
                                                        <option selected value="Xe côn">Xe côn</option>
                                                        <option value="Xe máy điện">Xe máy điện</option>
                                                    @else
                                                        <option  value="Số sàn">Số sàn</option>
                                                        <option value="Số tự động">Số tự động</option>
                                                        <option value="Xe số">Xe số</option>
                                                        <option  value="Xe tay ga">Xe tay ga</option>
                                                        <option value="Xe côn">Xe côn</option>
                                                        <option selected value="Xe máy điện">Xe máy điện</option>
                                                    @endif
                                                </select>
                                                @error('gear')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Mức tiêu thụ nhiên liệu (tính theo 100km):</label>
                                            <div class="col-md-9">
                                                <input type="text" name="consumption"  id="consumption" class="form-control @error('consumption') is-invalid @enderror" value="{{ $product->consumption}}" placeholder="Nhập số lít dầu/xăng/điện tiêu thụ">
                                                @error('consumption')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Thành Phố:</label>
                                            <div class="col-md-9">
                                                <select name="city_id"  id="city_id" class="form-control @error('city_id') is-invalid @enderror" value="{{ old('city_id') }}">
                                                    <option value="">Chọn thành phố (địa chỉ nhận xe)</option>
                                                    @foreach($cities as $city)
                                                        <option
                                                            @if($product->city_id == $city->id)
                                                            selected
                                                            @else

                                                            @endif
                                                            value="{{$city->id}}" >{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('city_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Quận:</label>
                                            <div class="col-md-9">
                                                <select name="district_id"  id="district_id" class="form-control @error('district_id') is-invalid @enderror" value="{{ old('district_id') }}">
                                                    <option value="">Chọn quận (địa chỉ nhận xe)</option>
                                                    @foreach($districts as $district)
                                                        <option
                                                            @if($product->district_id == $district->id)
                                                            selected
                                                            @else

                                                            @endif
                                                            value="{{$district->id}}" >{{$district->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('district_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Cập nhật </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection





