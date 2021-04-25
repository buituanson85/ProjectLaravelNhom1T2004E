@extends('layouts.Backend.base')
@section('title', 'Tạo phương tiện mới')
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
                        <span style="float: left"><a href="{{ route('partners.index') }}">Phương tiện</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('partners.create') }}">Thêm phương tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Thêm phương tiện của bạn</h4>
                            <div class="card-tools">
                                <a href="{{ route('partners.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-shield-alt"></i>Xem tất cả phương tiện của bạn</a>
                            </div>
                        </div>
                        <div class="alert-danger"></div>
                        <form class="form-group pt-3" method="POST" action="{{route('partners.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Tên phương tiện:</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
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
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
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
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
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
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label pull-right">Giá thuê theo ngày (VNĐ):</label>
                                            <div class="col-md-9">
                                                <input type="number" name="price"  id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
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
                                                <input type="number" name="insurance"  id="insurance" class="form-control @error('insurance') is-invalid @enderror" value="{{ old('insurance') }}">
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
                                                <input type="number" name="deposit"  id="deposit" class="form-control @error('deposit') is-invalid @enderror" value="{{ old('deposit') }}">
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
                                                <input type="number" name="km"  id="km" class="form-control @error('km') is-invalid @enderror" value="{{ old('km') }}">
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
                                                <input type="number" name="additional"  id="additional" class="form-control @error('additional') is-invalid @enderror" value="{{ old('additional') }}">
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
                                                    <option value="Xăng">Xăng</option>
                                                    <option value="Dầu">Dầu</option>
                                                    <option value="Điện">Điện</option>
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
                                                    <option value="Xe máy">Xe máy</option>
                                                    <option value="4 chỗ">4 Chỗ</option>
                                                    <option value="5 chỗ">5 Chỗ</option>
                                                    <option value="7 chỗ">7 Chỗ</option>
                                                    <option value="16 chỗ">Bán Tải</option>
                                                    <option value="Khác">Xe Sang</option>
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
                                                <input type="text" name="capacity"  id="seat" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" placeholder="Nhập số công suất tính theo CC hoặc mã lực (HP) (ví dụ: 110CC, 200HP,...)">
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
                                                    <option value="Sedan">Sedan</option>
                                                    <option value="Coupe">Coupe</option>
                                                    <option value="Sport">Sport</option>
                                                    <option value="Hatchback">Hatchback</option>
                                                    <option value="Minivan">Minivan</option>
                                                    <option value="Fashion">Fashion</option>
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
                                                    <option value="Số sàn">Số sàn</option>
                                                    <option value="Số tự động">Số tự động</option>
                                                    <option value="Xe số">Xe số</option>
                                                    <option value="Xe tay ga">Xe tay ga</option>
                                                    <option value="Xe côn">Xe côn</option>
                                                    <option value="Xe máy điện">Xe máy điện</option>
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
                                                <input type="text" name="consumption"  id="consumption" class="form-control @error('consumption') is-invalid @enderror" value="{{ old('consumption') }}" placeholder="Nhập số lít dầu/xăng/điện tiêu thụ">
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
                                                        <option value="{{$city->id}}">{{$city->name}}</option>
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
                                                        <option value="{{$district->id}}">{{$district->name}}</option>
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
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Đồng ý</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /#right-panel -->

@endsection




