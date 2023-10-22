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
                <div class="cart-header">
                    <h2 class="card-title fw-bolder mb-4">購物車</h2>
                    <div class="d-flex progress-block px-4 pb-4 mb-4 justify-content-around">
                        {{-- 進度條 --}}
                        <div class="d-flex flex-row align-item-center">
                            <div class="progress-title">
                                <div class="d-flex justify-content-center step step1">1</div>
                                <span class="step01">確認購物車</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-center">
                            <div class="progress-title">
                                <div class="d-flex justify-content-center step step2">2</div>
                                <span class="step02">付款與運送方式</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-center">
                            <div class="progress-title">
                                <div class="d-flex justify-content-center step step3">3</div>
                                <span class="step03">填寫資料</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-center progress-title">
                            <div class="d-flex justify-content-center step step4">4</div>
                            <span class="step04">完成訂購</span>
                        </div>
                    </div>
                </div>

                {{-- 付款與運送方式 --}}
                <div class="mt-4 pt-4 cart-detail">
                    <h3 class="mb-4">付款方式</h3>
                    <div class="form-check mb-4 ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            信用法付款
                        </label>
                    </div>
                    <div class="form-check mb-4 ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            網路 ATM
                        </label>
                    </div>
                    <div class="form-check mb-4 ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            超商代碼
                        </label>
                    </div>
                </div>
                <div class="mt-4 pt-4 cart-detail">
                    <h3 class="mb-4">運送方式</h3>
                    <div class="form-check mb-4 ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault1" checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            黑貓宅配
                        </label>
                    </div>
                    <div class="form-check mb-4 ms-4">
                        <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            超商店到店
                        </label>
                    </div>
                </div>

                {{-- 購物車的footer --}}
                <div class="cart-footer">
                    <div class="d-flex flex-column justify-content-end align-items-end my-4">
                        <div class="w-25 d-flex justify-content-between">
                            <span class="count">數量：</span><span class="fw-bolder fs-5">1</span>
                        </div>
                        <div class="w-25 d-flex justify-content-between">
                            <span class="subtotal">小計：</span><span class="fw-bolder fs-5">$6,400</span>
                        </div>
                        <div class="w-25 d-flex justify-content-between">
                            <span class="fee">運費：</span><span class="fw-bolder fs-5">$100</span>
                        </div>
                        <div class="w-25 d-flex justify-content-between">
                            <span class="total">總計：</span><span class="fw-bolder fs-5">$6,500</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('shopping-cart.step01') }}" class="btn px-5 fw-bolder btn-white border-primary border border-2 text-primary">上一步</a>
                        <a href="{{ route('shopping-cart.step03') }}" class="btn btn-primary">下一步</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    const minusBtns = document.querySelectorAll('.minus');
    const plusBtns = document.querySelectorAll('.plus');

    // 數量計算
    function qtyCalc(element, compute) {
        const qtyElement = element.parentElement.querySelector('.qty');
        let answer = 0;
        // if(compute == 'minus'){
        //     qty = Number(qtyElement.value) - 1;

        // }else{
        //     qty = Number(qtyElement.value) + 1;
        // }
        // 上述if判斷式可精簡為，但在click事件內要設定相對應的值
        answer = Number(qtyElement.value) + compute;
        qtyElement.value = answer < 1 ? 1 : answer;
    }

    // 價格計算
    function priceCalc(element) {
        const priceElement = element.parentElement.querySelector('.price');
        const qtyElement = element.parentElement.querySelector('.qty');
        let price = priceElement.getAttribute('data-single');
        let qty = qtyElement.value;
        let total = price * qty;
        priceElement.textContent = `\$ ${total.toLocaleString()}`;
    }

    minusBtns.forEach(function(minusBtn) {
        minusBtn.addEventListener('click', function(){
            // if判斷是會用到
            //qtyCalc(this, 'minus');
            qtyCalc(this, -1);
            priceCalc(this);
        });
    });

    plusBtns.forEach(function(plusBtn){
        plusBtn.addEventListener('click', function(){
            // if判斷是會用到
            // qtyCalc(this, 'plus');
            qtyCalc(this, 1);
            priceCalc(this);
        });
    });


</script>

@endsection
