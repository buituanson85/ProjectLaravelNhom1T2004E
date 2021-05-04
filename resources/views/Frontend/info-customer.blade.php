
@extends('layouts.Frontend.base')
@section('title', 'Home Pages')
@section('content')


<style>
.content{
    background: #f2f4f7;

    height: auto;
    padding: 30px 0;
}
.info{
    display: flex;
    justify-content: space-between;
    background-color: #f2f4f7;
}
/*left*/
.info_left{
    flex: 1;
    background-color: white;


}
.info_left_detail{
    padding: 20px;
}
.info_left_detail_img{
    width: 100%;
    height: 200px;
}

/*right*/
.info-right{
    flex: 2;
    background-color: white;
    height: 600px;

    margin-left: 20px;
}

.product_detail{
    /*display: flex;*/
}
.product_detail_type{
    flex: 1;
}


.form_submit{
    padding: 30px;
}

 </style>

<div class="content">
    <div class="container">
        <div class="info">
            <div class="info_left">
                <div class="info_left_detail">
                    <div class="info_left_detail_img">
                        <img src="{{ $product->image }}" style="width: 100%; height: 100%" alt="">
                    </div>
                    <h3 style="text-align: center;color: teal">{{ $product->name }}</h3>
                    <p style="text-align: center;color: teal">Hoặc tương đương</p>
                    <div class="product_detail" >
                        <div class="row" style="width: 80%">
                            <div class="col-md-6">
                                <p><i class="fas fa-map-marked-alt"></i> {{$product->district->name}}</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-cogs"></i>  {{$product->gear}}</p>
                            </div>
                        </div>
                        <div class="row" style="width: 100%">
                            <div class="col-md-6">

                                @if($product->engine=="")
                                <p ><i class="fas fa-gas-pump" ></i> Xăng</p>
                                @else
                                <p ><i class="fas fa-gas-pump" ></i> {{$product->engine}}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-tachometer-alt"></i> {{$product->consumption}}</p>
                            </div>
                        </div>
                        <div class="row" style="width: 100%">
                            <div class="col-md-6">
                                <p><i class="fas fa-car"></i> {{$product->range}}</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fas fa-prescription-bottle"></i> {{$product->capacity}}</p>
                            </div>
                        </div>
                    </div>
                    <span>
                        <h5 style="text-transform: uppercase">Hình thức nhận xe</h5>
                         <p>{{$receive_method}}</p>
                    </span>
                    <span>
                         <h5 style="text-transform: uppercase">Thời gian</h5>
                        <p>{{$start_time}} - {{$end_time}}</p>
                    </span>
                    <span>
                         <h5 style="text-transform: uppercase">GIỚI HẠN QUÃNG ĐƯỜNG</h5>

                        <p>Tối đa 350 km/ngày, phụ trội 3.000 đ/km</p>
                    </span>
                    <span>
                        <h5 style="text-transform: uppercase">Chi tiết giá</h5>
                        <span style="display: flex; justify-content: space-between">
                            <p>Đơn giá:</p>
                            <p style="font-weight: 700">{{ number_format($product->price) }} VNĐ</p>
                        </span>
                        <span style="display: flex; justify-content: space-between">
                            <p>Thời gian thuê:</p>
                            <p style="font-weight: 700">{{$total_time_send}} Ngày</p>
                        </span>

                        @if($product->category_id == 2)
                        <span style="display: flex; justify-content: space-between">
                            <p>Số lượng</p>
                            <p style="font-weight: 700">{{ $quantity }} Chiếc</p>
                        </span>
                        @else
                        @endif
                    </span>
                    <hr>
                    <span style="display: flex; justify-content: space-between">
                        <p>Bảo hiểm xe</p>
                        <p style="font-weight: 700">{{ number_format($product->insurrance) }} VNĐ</p>
                    </span>

                    <hr>
                    <span style="display: flex; justify-content: space-between">
                        <h5 style="text-transform: uppercase;color: teal" >Tổng</h5>
                        <h5 style="font-weight: 700;color: teal">{{ number_format($total_price) }} VNĐ</h5>
                    </span>

                </div>

            </div>
            <div class="info-right pb-2 pt-3">
                <div class="info-right_fix">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 style="text-align: center;color: teal">THÔNG TIN KHÁCH HÀNG</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align: center;color: teal">Nhập thông tin cá nhân để tiến hành đặt</p>

                        </div>
                    </div>
                   <div class="row">
                       <div class="col-md-12 pb-5">
                           <form action="{{route('order.store')}}" method="post">
                            @csrf
                                <input type="hidden" name="price_total" value="{{ $total_price }}"/>
                                <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                <input type="hidden" name="product_receive_date" value="{{ $start_time }}"/>
                                <input type="hidden" name="product_pay_date" value="{{ $end_time }}"/>
                                <input type="hidden" name="receive_Method" value="{{ $receive_method }}"/>
                               <input type="hidden" name="quantity" value="{{ $quantity }}"/>
                               <div class="form-group row">
                                   <label for="inputname" class="col-sm-3 col-form-label">Họ và tên</label>
                                   <div class="col-sm-9">
                                       <input type="text" class="form-control"
                                       id="inputname" name="inputname" disabled="disabled" value="{{Auth::user()->name}}" placeholder="Họ và tên">
                                   </div>
                               </div>
                               <div class="form-group row">
                                <label for="inputname" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                    id="inputemail" name="inputemail" disabled="disabled" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                               <div class="form-group row">
                                   <label for="inputphone" class="col-sm-3 col-form-label">Số điện thoại</label>
                                   <div class="col-sm-9">
                                       <input type="text"
                                       class="form-control" name="inputphone" id="inputphone" value="{{ Auth::user()->phone }}" readonly>
                                   </div>
                               </div>

                               <div class="form-group row">
                                   <label  class="col-sm-3 col-form-label">Ghi chú của khách hàng</label>
                                   <div class="col-sm-9">

                                       <textarea class="form-control" placeholder="Nhập ghi chú" name="note"
                                       id="note" style="height: 100px">

                                       </textarea>

                                   </div>
                               </div>
                               <div class="form-group row">
                                   <label  class="col-sm-3 col-form-label">Hình thức thanh toán</label>
                                   <div class="col-sm-9">

                                       <div class="form-check">
                                           <input class="form-check-input" type="radio" name="payment_id"
                                           id="exampleRadios1" value="1" checked>
                                           <label class="form-check-label" for="exampleRadios1">
                                               Trả tiền mặt
                                           </label>
                                       </div>
                                       <div class="form-check">
                                           <input class="form-check-input" type="radio" name="payment_id" id="exampleRadios2" value="2">
                                           <label class="form-check-label" for="exampleRadios2">
                                               Thanh toán bằng thẻ
                                           </label>
                                       </div>

                                   </div>

                               </div>

                               <div class="form-group row">
                                   <div class="col-sm-3"></div>
                                   <div class="col-sm-6 pb-3">
                                       <button type="submit" class="btn btn-primary">Nhập thông tin để toàn tất</button>
                                   </div>
                               </div>
                           </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
