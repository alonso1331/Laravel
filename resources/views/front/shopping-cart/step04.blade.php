@extends('layouts.template')

@section('title', '完成訂購')

@section('css')
<link rel="stylesheet" href="{{ asset('css/step04.css') }}">
@endsection

@section('main')
<div id="cart" class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                {{-- 購物車的header --}}
                @include('front.shopping-cart.shopping-cart-header', ['step'=>4])

                {{-- 付款與運送方式 --}}
                <div class="mt-4 pt-4 cart-detail fs-5">
                    <h3 class="mb-4">訂單明細</h3>
                    {{-- 不建議在blade 長其他php 程式 --}}
                    @php
                        $totalQty = 0;
                        $subtotal = 0;
                    @endphp
                    @foreach ($order->orderDetails as $orderDetail)
                    {{-- @foreach ($orders as $order) --}}
                    @php
                        $totalQty += $orderDetail->qty;
                        $totalPrice = $orderDetail->price * $orderDetail->qty;
                        $subtotal += $totalPrice;
                    @endphp
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-item-center">
                                <img src="{{ Storage::url($orderDetail->image_url) }}" alt="" class="me-3" width="200px">
                                <div class="produc-info d-flex align-items-center">{{ $orderDetail->name }}</div>
                            </div>
                            <div class="order-item-price item">
                                <span class="qty">X {{ $orderDetail->qty }}</span>
                                <span class="ms-4 price">合計：<span class="fw-bolder">$ {{ $totalPrice }}</span></span>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <h3 class="mt-5 mb-4">寄送資料</h3>
                    <div class="ms-4">
                        <div class="mb-2">姓名：<span>{{ $order->name }}</span></div>
                        <div class="mb-2">電話：<span>{{ $order->phone }}</span></div>
                        <div class="mb-2">Email：<span>{{ $order->email }}</span></div>
                        <div>地址：<span>{{ $order->address }}</span></div>
                    </div>
                    <h3 class="mt-5 mb-4">付款及運送方式</h3>
                    @php
                        use App\Models\Order;
                    @endphp
                    <div class="ms-4">
                        <div class="mb-2">付款方式：<span>{{ Order::PAYMENT[$order->payment] }}</span></div>
                        <div class="mb-2">付款狀態：<span>{{ Order::ISPAID[$order->is_paid] }}</span></div>
                        <div class="mb-2">運送方式：<span>{{ Order::SHIPMENT[$order->shipment] }}</span></div>
                    </div>
                </div>

                {{-- 購物車的footer --}}
                @include('front.shopping-cart.shopping-cart-footer', ['step'=>4, 'totalQty'=>$totalQty, 'subtotal'=>$subtotal])
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    // const next = document.querySelector('#next');
    // next.addEventListener('click', function(){
    //     // document.querySelector('#step03').submit();
    //     // 當click 前往結帳的按鈕時，同時click #sumbit-btn，藉由當#sumbit-btn 做表單驗證
    //     document.querySelector('#sumbit-btn').click();
    // });
</script>
@endsection
