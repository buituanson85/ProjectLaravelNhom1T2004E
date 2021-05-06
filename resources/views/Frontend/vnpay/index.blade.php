@extends('layouts.Frontend.base')
@section('title', 'Home Pages')
@section('content')
<style>
    .banner-product{
        background: #f2f4f7;
        padding: 30px 0;
        height: auto;
    }
</style>

<div class="container-fluid banner-product">
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card-header">
                    <h3 class="text-center" style="font-size: 20px">Cổng thanh toán VNPAY</h3>
                </div>
                <div class="card-body" style="background-color: #ffffff">
                    <div class="table-responsive">

                        <form action="{{ route('pages.paymentonline') }}" id="create_form" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="language">Loại Thanh Toán: </label>
                                <select name="order_type" id="order_type" class="form-control">
                                    <option value="billpayment">Thanh toán hóa đơn</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">Số tiền:</label>
                                <input class="form-control" id="price"
                                       name="price" type="number" value="{{ $price_total }}" readonly/>
                                <input class="form-control" id="amount"
                                       name="amount" type="number" value="{{ $price_total }}" style="display: none"/>
                            </div>
                            <div class="form-group">
                                <label for="order_desc">Nội dung thanh toán:</label>
                                <textarea class="form-control" cols="20" placeholder="Noi dung thanh toan" id="order_desc" name="order_desc" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="bank_code">Ngân hàng</label>
                                <select name="bank_code" id="bank_code" class="form-control">
                                    <option value="">Không chọn</option>
                                    <option value="NCB"> Ngan hang NCB</option>
                                    <option value="AGRIBANK"> Ngan hang Agribank</option>
                                    <option value="SCB"> Ngan hang SCB</option>
                                    <option value="SACOMBANK">Ngan hang SacomBank</option>
                                    <option value="EXIMBANK"> Ngan hang EximBank</option>
                                    <option value="MSBANK"> Ngan hang MSBANK</option>
                                    <option value="NAMABANK"> Ngan hang NamABank</option>
                                    <option value="VNMART"> Vi dien tu VnMart</option>
                                    <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                    <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                    <option value="HDBANK">Ngan hang HDBank</option>
                                    <option value="DONGABANK"> Ngan hang Dong A</option>
                                    <option value="TPBANK"> Ngân hàng TPBank</option>
                                    <option value="OJB"> Ngân hàng OceanBank</option>
                                    <option value="BIDV"> Ngân hàng BIDV</option>
                                    <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                    <option value="VPBANK"> Ngan hang VPBank</option>
                                    <option value="MBBANK"> Ngan hang MBBank</option>
                                    <option value="ACB"> Ngan hang ACB</option>
                                    <option value="OCB"> Ngan hang OCB</option>
                                    <option value="IVB"> Ngan hang IVB</option>
                                    <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="language">Ngôn ngữ</label>
                                <select name="language" id="language" class="form-control">
                                    <option value="vn">Tiếng Việt</option>
                                    <option value="en">English</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" id="btnPopup">Xác Nhận Thanh Toán</button>
                            <button type="button" onclick="history.back()" class="btn btn-default">Quay trở lại</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>

@endsection

