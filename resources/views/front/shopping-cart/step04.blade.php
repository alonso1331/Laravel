@extends('layouts.template')

@section('title', '填寫運送資料')

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
                    @foreach ($items as $item)
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-item-center">
                                <img src="{{ Storage::url($item->attributes->image_url) }}" alt="" class="me-3" width="200px">
                                <div class="produc-info d-flex align-items-center">{{ $item->name }}</div>
                            </div>
                            <div class="order-item-price item" data-id="{{ $item->id }}">
                                <span class="qty">X {{ $item->quantity }}</span>
                                <span class="ms-4 price" data-single="{{ $item->price }}">合計：<span class="fw-bolder">${{ number_format($item->price*$item->quantity) }}</span></span>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <h3 class="my-4">寄送資料</h3>
                    <div class="ms-4">
                        <div class="mb-2">姓名：<span>陳○○</span></div>
                        <div class="mb-2">電話：<span>02-23456789</span></div>
                        <div class="mb-2">Email：<span>123@mail.com</span></div>
                        <div>地址：<span>臺北市萬華區大理街123號</span></div>
                    </div>
                </div>

                {{-- 購物車的footer --}}
                @include('front.shopping-cart.shopping-cart-footer', ['step'=>4])
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    const next = document.querySelector('#next');
    next.addEventListener('click', function(){
        // document.querySelector('#step03').submit();
        // 當click 前往結帳的按鈕時，同時click #sumbit-btn，藉由當#sumbit-btn 做表單驗證
        document.querySelector('#sumbit-btn').click();
    });
</script>
@endsection
