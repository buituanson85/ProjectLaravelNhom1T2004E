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
                        <span style="float: left">Dashboard</span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('product.index') }}">Phương tiện</a></span>
                        <span style="float: left;margin: 0 5px">/</span>
                        <span style="float: left"><a href="{{ route('product.edit', $product->id) }}">Chỉnh sửa phương tiện</a></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumbs">
            <div class="row pt-5">
                <div class="col-md-10 offset-md-1">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Chỉnh sửa phương tiện của bạn</h4>
                            <div class="card-tools">
                                <a href="{{ route('product.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-shield-alt"></i>Xem tất cả phương tiện của bạn</a>
                            </div>
                        </div>
                        <div class="alert-danger"></div>
                        <form class="form-group pt-3" method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                                    <option value="Xăng" {{$product->engine == 'Xăng'?'selected':''}}>Xăng</option>
                                                    <option value="Dầu" {{$product->engine == 'Dầu'?'selected':''}}>Dầu</option>
                                                    <option value="Điện" {{$product->engine == 'Điện'?'selected':''}}>Điện</option>
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
                                                    <option value="Xe máy" {{$product->seat == 'Xe máy'?'selected':''}}>Xe máy</option>
                                                    <option value="4-5 chỗ" {{$product->seat == '4-5 chỗ'?'selected':''}}>4-5 chỗ</option>
                                                    <option value="7 chỗ" {{$product->seat == '7 chỗ'?'selected':''}}>7 chỗ</option>
                                                    <option value="16 chỗ" {{$product->seat == '16 chỗ'?'selected':''}}>16 chỗ</option>
                                                    <option value="Khác" {{$product->seat == 'Khác'?'selected':''}}>Loại khác</option>
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
                                                    <option value="Sedan" {{$product->range == 'Sedan'?'selected':''}}>Sedan</option>
                                                    <option value="Coupe" {{$product->range == 'Coupe'?'selected':''}}>Coupe</option>
                                                    <option value="Sport" {{$product->range == 'Sport'?'selected':''}}>Sport</option>
                                                    <option value="Hatchback" {{$product->range == 'Hatchback'?'selected':''}}>Hatchback</option>
                                                    <option value="Minivan" {{$product->range == 'Minivan'?'selected':''}}>Minivan</option>
                                                    <option value="Motor" {{$product->range == 'Motor'?'selected':''}}>Xe máy</option>
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
                                                    <option value="Xe ô tô số sàn" {{$product->gear == 'Xe ô tô số sàn'?'selected':''}}>Xe ô tô số sàn</option>
                                                    <option value="Xe ô tô số tự động" {{$product->gear == 'Xe ô tô số tự động'?'selected':''}}>Xe ô tô tự động</option>
                                                    <option value="Xe máy tay ga" {{$product->gear == 'Xe máy tay ga'?'selected':''}}>Xe máy tay ga</option>
                                                    <option value="Xe máy tay côn" {{$product->gear == 'Xe máy tay côn'?'selected':''}}>Xe máy tay côn</option>
                                                    <option value="Xe máy số" {{$product->gear == 'Xe máy số'?'selected':''}}>Xe máy số</option>
                                                    <option value="Xe máy điện" {{$product->gear == 'Xe máy điện'?'selected':''}}>Xe máy điện</option>
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
                                            <label class="col-md-3 col-form-label pull-right">Quận:</label>
                                            <div class="col-md-9">
                                                <select name="district_id"  id="district_id" class="form-control @error('district_id') is-invalid @enderror" value="{{ old('district_id') }}">
                                                    <option value="">Chọn quận (địa chỉ nhận xe)</option>
                                                    @foreach($districts as $district)
                                                        @if($product->district_id == $district->id)
                                                        <option value="{{$district->id}}" selected>{{$district->name}}</option>
                                                        @else
                                                        <option value="{{$district->id}}" selected>{{$district->name}}</option>
                                                        @endif
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




