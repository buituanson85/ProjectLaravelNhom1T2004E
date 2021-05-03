@extends('layouts.Frontend.base')
@section('title', 'Thông tin cá nhân')
@section('content')
    <div class="container-fluid banner-product">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-4">
                        <div class="info-left"  style="background-color: white">
                            <div class="info-left-general ">
                                <a href="{{ route('pages.lichsuthuexe') }}"><i class="fas fa-folder-open"></i> Lịch sử thuê xe</a>
                            </div>
                            <div class="info-left-general-active">
                                <a href="{{ route('pages.customerprofiles') }}"><i class="fas fa-user-alt"></i> Thông tin cá nhân</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('pages.doimatkhau') }}"><i class="fas fa-cog"></i> Đổi mật khẩu</a>
                            </div>
                            <div class="info-left-general">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                <form id="logout-form"  action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-8" >
                        <div class="info-right" style="height: auto">
                            <p style="text-align: center;color: cadetblue;font-weight: 600;font-size: 20px;padding-top: 30px">THÔNG TIN CÁ NHÂN</p>
                            <div class="container">
                                <form method="post" action="{{ route('capnhatprofile') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="row p-0">
                                    <div class="col-3" style="padding-top: 10px">
                                        <div class="info-right-input-img">
                                            <input type="file" id="images" name="images" class="input-file_ava ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                            <label for="files_ava">
                                                <img src="{{ $user->profile_photo_path }}" style="width: 130px;height: 130px;border-radius: 10px; border: 1px solid cadetblue  " alt="">

                                                <output id="list_ava">

                                                </output>
                                            </label>
                                        </div>
                                    </div>
                                    @include('partials.alert')
                                    <div class="col-9" style="margin-top: -20px">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-4 col-form-label" style="font-weight: 600">Họ và tên</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-4 col-form-label" style="font-weight: 600">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="email" name="email"  value="{{ $user->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone" class="col-sm-4 col-form-label" style="font-weight: 600">Số điện thoại</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                            </div>
                                        </div>

                                        <div class="form-group row pb-3">
                                            <label for="phone" class="col-sm-4 col-form-label" style="font-weight: 600">Địa chỉ</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                                            </div>
                                        </div>
                                        <button  type="submit" class="form_submit_info" style="background-color: cadetblue; padding: 10px;border-radius: 5px;color: white;font-weight: 600; margin-left: 250px; margin-top: -30px"><i class="fas fa-edit"></i> Chỉnh sửa</button>
                                    </div>
                                </div>
                                </form>
                                <div class="row">
                                    @if(!isset($file))
                                        <form action="{{ route('taianhgalaxy') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="Banglai">
                                                <p style="font-weight: 600">Bằng lái xe</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_blxmt">
                                                            <input type="file" id="imgae_1" name="image_1" class="input-file_blxmt ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_blxmt">
                                                        <span class="add-image_blxmt">
                                                            Tải ảnh mặt trước
                                                        </span>
                                                                <output id="list_blxmt"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="upload_blxms">
                                                            <input type="file" id="image_2" name="image_2" class="input-file_blxms ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_blxms">
                                                        <span class="add-image_blxms">
                                                            Tải ảnh mặt sau
                                                        </span>
                                                                <output id="list_blxms"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="CMT">
                                                <p style="font-weight: 600;">Chứng minh nhân dân/ Thẻ căn cước/ Passport</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_cmtmt">
                                                            <input type="file" id="image_3" name="image_3" class="input-file_cmtmt ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_cmtmt">
                                                        <span class="add-image_cmtmt">
                                                            Tải ảnh mặt trước
                                                        </span>
                                                                <output id="list_cmtmt"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="upload_cmtms">
                                                            <input type="file" id="image_4" name="image_4" class="input-file_cmtms ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_cmtms">
                                                        <span class="add-image_cmtms">
                                                            Tải ảnh mặt sau
                                                        </span>
                                                                <output id="list_cmtms"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="SHK" >
                                                <p style="font-weight: 600">Sổ hộ khẩu/KT3</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_shk">
                                                            <input type="file" id="image_5" name="image_5" class="input-file_shk ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_shk">
                                                        <span class="add-image_shk">
                                                            Tải ảnh mặt trước
                                                        </span>
                                                                <output id="list_shk"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                        </form>
                                    @else
                                        <form action="{{ route('capnhatgalaxy') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="Banglai">
                                                <p style="font-weight: 600">Bằng lái xe</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_blxmt">
                                                            <input type="file" id="imgae_1" name="image_1" class="input-file_blxmt ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_blxmt">
                                                                <img src="{{ $file->cmt_before }}" class="add-image_blxmt2">
                                                                <output id="list_blxmt"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="upload_blxms">
                                                            <input type="file" id="image_2" name="image_2" class="input-file_blxms ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_blxms">
                                                                <img src="{{ $file->cmt_after }}" class="add-image_blxmt2">
                                                                <output id="list_blxms"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="CMT">
                                                <p style="font-weight: 600;">Chứng minh nhân dân/ Thẻ căn cước/ Passport</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_cmtmt">
                                                            <input type="file" id="image_3" name="image_3" class="input-file_cmtmt ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_cmtmt">
                                                                <img src="{{ $file->license_before }}" class="add-image_blxmt2">
                                                                <output id="list_cmtmt"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="upload_cmtms">
                                                            <input type="file" id="image_4" name="image_4" class="input-file_cmtms ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_cmtms">
                                                                <img src="{{ $file->license_after }}" class="add-image_blxmt2">
                                                                <output id="list_cmtms"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="SHK" >
                                                <p style="font-weight: 600">Sổ hộ khẩu/KT3</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="upload_shk">
                                                            <input type="file" id="image_5" name="image_5" class="input-file_shk ng-pristine ng-valid ng-touched" files-model="" ng-model="project.fileList">
                                                            <label for="files_shk">
                                                                <img src="{{ $file->registration_book }}" class="add-image_blxmt2">
                                                                <output id="list_shk"></output>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

