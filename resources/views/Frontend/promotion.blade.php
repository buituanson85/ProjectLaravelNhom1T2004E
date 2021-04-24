@extends('layouts.Frontend.base')
@section('title', 'Khuyến mãi')
@section('content')
    <main>
        <div>
            <div class="container-page-sub" style="background-color: rgb(245, 245, 245);">
                <div class="header-page-sub">
                    <div class="bg-page-sub" style="background-size: auto;height: auto;color: #171717">KHUYẾN MÃI</div>
                </div>
                <div class="body-child" style="background-color: rgb(245, 245, 245);">
                    <div class="item-promotion"><a target="_blank" rel="noopener noreferrer"
                                                   href="https://chungxe.vn/blog/tung-bung-ra-mat-website-moi-nhan-code-giam-gia-chungxe/"
                                                   class="btn-item-promotion">
                            <div class="img-promotion"><img src="{{ asset('Frontend/assets/images/promotion.jpg') }}"
                                                            alt="Khuyến mại ra mắt website. Nhập mã 'CHUNGXE' giảm ngay 10%.">
                            </div>
                            Xem chi tiết
                            <button class="copy-code-promotion">Copy mã</button>
                        </a></div>
                    <div class="item-promotion"><a target="_blank" rel="noopener noreferrer"
                                                   href="https://chungxe.vn/blog/chao-mung-phu-quoc-voi-ma-khuyen-mai-cx10/"
                                                   class="btn-item-promotion">
                            <div class="img-promotion"><img src="{{ asset('Frontend/assets/images/phuquoc.png') }}"
                                                            alt="Khuyến mại ChungXe có thêm địa điểm mới. Nhập mã 'CX10' giảm ngay 10%.">
                            </div>
                            Xem chi tiết
                            <button class="copy-code-promotion">Copy mã</button>
                        </a></div>
                    <div class="item-promotion"><a target="_blank" rel="noopener noreferrer"
                                                   href="https://chungxe.vn/blog/nong-uu-dai-khi-thue-xe-tu-lai-nhan-ngay-8-3/"
                                                   class="btn-item-promotion">
                            <div class="img-promotion"><img src="{{ asset('Frontend/assets/images/womenday2020.jpg') }}"
                                                            alt="Khuyến mại 8/3/2020. Nhập mã 'PHUNU' giảm ngay 50k.">
                            </div>
                            Xem chi tiết
                            <button class="copy-code-promotion">Copy mã</button>
                        </a></div>
                </div>
            </div>
        </div>
    </main>
@endsection

