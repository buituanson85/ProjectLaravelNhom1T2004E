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
                        <span style="float: left"><a href="{{ route('products.index') }}">Danh sách phương tiện</a></span>
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
                                <div class="col-md-5">
                                    <h3 class="card-title">Thêm mới phương tiện</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('products.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> See all Partner</a>
                                    </div>
                                </div>
                                <div class="col-md-7 pt-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h6>Partner: {{ $user->name }}</h6>
                                        </div>
                                        <div class="col-md-5">
                                            <img width="70" src="{{ asset('Backend/uploads/users') }}/{{ $user->profile_photo_path }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @include('partials.alert')
                        <div class="alert-danger"></div>
                        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="partner_id" name="partner_id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tên Xe:</label>
                                            <input type="text" name="name" onkeyup="ChangeToSlug()"  id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Product Name">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slug">Xe Slug:</label>
                                            <input type="text" name="slug"  id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" placeholder="Product Slug">
                                            @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="image">Ảnh Xe:</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="file" name="image" id="image" class="input-file @error('image') is-invalid @enderror" value="{{ old('image') }}" alt="abc">
                                                <div class="image-preview" id="imagePreview">
                                                    <img class="image-preview__image" width="150px" src="" id="img_thumbnail" alt="">
                                                    <span id="store_image" class="image-preview__default-text"></span>
                                                </div>
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="price">Giá Thuê/Ngày:</label>
                                                    <input type="text" name="price"  id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="Product Price">
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
                                                    <input type="text" name="insurrance"  id="insurrance" class="form-control @error('insurrance') is-invalid @enderror" value="{{ old('insurrance') }}" placeholder="Product Insurrance">
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
                                                    <input type="text" name="deposit"  id="deposit" class="form-control @error('deposit') is-invalid @enderror" value="{{ old('deposit') }}" placeholder="Product Deposit">
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
                                                    <input type="text" name="km"  id="km" class="form-control @error('km') is-invalid @enderror" value="{{ old('km') }}" placeholder="Product Km">
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
                                                    <input type="text" name="additional"  id="additional" class="form-control @error('additional') is-invalid @enderror" value="{{ old('additional') }}" placeholder="Product Additional">
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
                                                    <input type="text" name="seat"  id="seat" class="form-control @error('seat') is-invalid @enderror" value="{{ old('seat') }}" placeholder="Product Seat">
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

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="capacity">Dung Tích Xe:</label>
                                            <input type="text" name="capacity"  id="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ old('capacity') }}" placeholder="Product Capacity">
                                            @error('capacity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="range">Kiểu Xe:</label>
                                            <input type="text" name="range"  id="range" class="form-control @error('range') is-invalid @enderror" value="{{ old('range') }}" placeholder="Product Range">
                                            @error('range')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="gear">Hộp Số:</label>
                                            <input type="text" name="gear"  id="gear" class="form-control @error('gear') is-invalid @enderror" value="{{ old('gear') }}" placeholder="Product Gear">
                                            @error('gear')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="consumption">Mức Tiêu Thụ Năng Lượng:</label>
                                            <input type="text" name="consumption"  id="consumption" class="form-control @error('consumption') is-invalid @enderror" value="{{ old('consumption') }}" placeholder="Product Consumption">
                                            @error('consumption')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Năng Lượng</label>
                                            <select class="form-control @error('engine') is-invalid @enderror" id="engine" name="engine">
                                                <option value="">=== Select Option ===</option>
                                                <option value="gasoline">Gasoline</option>
                                                <option value="oil">Oil</option>
                                            </select>
                                            @error('engine')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status">Trạng Thái</label>
                                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                                <option value="">=== Select Option ===</option>
                                                <option value="instock">InStock</option>
                                                <option value="outofstock">Out of Stock</option>
                                            </select>
                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Loại Xe:</label>
                                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                                <option value="">=== Select Option ===</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="brand_id">Thương Hiệu:</label>
                                            <select class="form-control @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                                                <option value="">=== Select Option ===</option>
                                                @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="district_id">Khu Vực Đăng Ký:</label>
                                            <select class="form-control @error('district_id') is-invalid @enderror" id="district_id" name="district_id">
                                                <option value="">=== Select Option ===</option>
                                                @foreach($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
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

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Create Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /#right-panel -->

@endsection

