@extends('layouts.template')

@section('title', '填寫運送資料')

@section('css')
<link rel="stylesheet" href="{{ asset('css/step03.css') }}">
@endsection

@section('main')
<div id="cart" class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                {{-- 購物車的header --}}
                @include('front.shopping-cart.shopping-cart-header', ['step'=>3])

                {{-- 付款與運送方式 --}}
                <div class="mt-4 pt-4 cart-detail">
                    <h3 class="mb-4">計送資料</h3>
                    <form action="{{ route('shopping-cart.step03-store') }}" method="post" id="step03-form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fs-5">姓名</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="basic-addon3 basic-addon4" placeholder="陳○○" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label fs-5">電話</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="phone" id="phone" aria-describedby="basic-addon3 basic-addon4" placeholder="0912345678 or 02-12345678" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fs-5">Email</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="email" id="email" aria-describedby="basic-addon3 basic-addon4" placeholder="abc123@meil.com" required>
                            </div>
                        </div>
                        <div class="mb-3 d-flex flex-wrap justify-content-between">
                            <label for="address" class="form-label fs-5 col-12">地址</label>
                            {{-- <div class="input-group" style="width: 49%">
                                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4" placeholder="郵遞區號">
                            </div>
                            <div class="input-group" style="width: 49%">
                                <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4" placeholder="城市">
                            </div> --}}
                            <div class="input-group col-12">
                                <input type="text" class="form-control" name="address" id="address" aria-describedby="basic-addon3 basic-addon4" placeholder="地址" required>
                            </div>
                        </div>
                        {{-- 用js 送表單會產生一個問題，就是html 的檢核功能會無效，所以要隱藏一個button 做驗證 --}}
                        <button id="sumbit-btn" hidden></button>
                    </form>
                </div>

                {{-- 購物車的footer --}}
                @include('front.shopping-cart.shopping-cart-footer', ['step'=>3])
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
