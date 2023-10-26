{{-- 購物車的header --}}
<div class="cart-header">
    <h2 class="card-title fw-bolder mb-4">購物車</h2>
    <div class="d-flex progress-block px-4 pb-4 mb-4 justify-content-center">
        {{-- 進度條 --}}
        <div class="d-flex flex-row align-item-center me-4">
            <div class="progress-title">
                <div class="d-flex justify-content-center step step1">1</div>
                <span class="step01">確認購物車</span>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: @if($step > 1)100% @elseif($step == 1)30% @else 0% @endif" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="d-flex flex-row align-center me-4">
            <div class="progress-title">
                <div class="d-flex justify-content-center step step2">2</div>
                <span class="step02">付款與運送方式</span>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: @if($step > 2)100% @elseif($step == 2)30% @else 0% @endif" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="d-flex flex-row align-center me-4">
            <div class="progress-title">
                <div class="d-flex justify-content-center step step3">3</div>
                <span class="step03">填寫資料</span>
            </div>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" style="width: @if($step > 3)100% @elseif($step == 3)30% @else 0% @endif" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="d-flex flex-column align-center progress-title">
            <div class="d-flex justify-content-center step step4">4</div>
            <span class="step04">完成訂購</span>
        </div>
    </div>
</div>
