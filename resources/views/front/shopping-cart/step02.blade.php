@extends('layouts.template')

@section('title', '付款與運送方式')

@section('css')
<link rel="stylesheet" href="{{ asset('css/step02.css') }}">
@endsection

@section('main')
<div id="cart" class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                {{-- 購物車的header --}}
                @include('front.shopping-cart.shopping-cart-header',['step'=>2])

                {{-- 付款與運送方式 --}}
                <form action="{{ route('shopping-cart.step02-store') }}" method="post" id="step02">
                    @csrf
                    <div class="mt-4 pt-4 cart-detail">
                        <h3 class="mb-4">付款方式</h3>
                        <div class="form-check mb-4 ms-4">
                            <input class="form-check-input" type="radio" name="payment" id="credit-card" value="0" checked>
                            <label class="form-check-label" for="credit-card">信用法付款</label>
                        </div>
                        <div class="form-check mb-4 ms-4">
                            <input class="form-check-input" type="radio" name="payment" id="atm" value="1">
                            <label class="form-check-label" for="atm">網路 ATM</label>
                        </div>
                        <div class="form-check mb-4 ms-4">
                            <input class="form-check-input" type="radio" name="payment" id="cvs-code" value="2">
                            <label class="form-check-label" for="cvs-code">超商代碼</label>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 cart-detail">
                        <h3 class="mb-4">運送方式</h3>
                        <div class="form-check mb-4 ms-4">
                            <input class="form-check-input" type="radio" name="shipment" id="home" value="0" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                黑貓宅配
                            </label>
                        </div>
                        <div class="form-check mb-4 ms-4">
                            <input class="form-check-input" type="radio" name="shipment" id="cvs" value="1">
                            <label class="form-check-label" for="cvs">
                                超商店到店
                            </label>
                        </div>
                    </div>
                     {{-- 用js 送表單會產生一個問題，就是html 的檢核功能會無效，所以要隱藏一個button 做驗證 --}}
                    <button id="sumbit-btn" hidden></button>
                </form>

                {{-- 購物車的footer --}}
                @include('front.shopping-cart.shopping-cart-footer', ['step'=>2])
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    const next = document.querySelector('#next');
    next.addEventListener('click', function(){
        // document.querySelector('#step02').submit();
        // 當click 前往結帳的按鈕時，同時click #sumbit-btn，藉由當#sumbit-btn 做表單驗證
        document.querySelector('#sumbit-btn').click();
    });
</script>
@endsection
