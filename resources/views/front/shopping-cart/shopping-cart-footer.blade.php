<div class="cart-footer">
    <div class="d-flex flex-column justify-content-end align-items-end my-4">
        <div class="w-25 d-flex justify-content-between">
            <span class="count">數量：</span><span class="fw-bolder fs-5">{{\Cart::getTotalQuantity()}}</span>
        </div>
        <div class="w-25 d-flex justify-content-between">
            <span class="subtotal">小計：</span><span class="fw-bolder fs-5">${{number_format(\Cart::getSubTotal())}}</span>
        </div>
        <div class="w-25 d-flex justify-content-between">
            <span class="fee">運費：</span><span class="fw-bolder fs-5">$60</span>
        </div>
        <div class="w-25 d-flex justify-content-between">
            <span class="total">總計：</span><span class="fw-bolder fs-5">${{number_format(\Cart::getTotal()+60)}}</span>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-4">
        @if ($step == 1)
            <a href="{{ route('products.list') }}" class="btn px-5 fw-bolder"><i class="fa-solid fa-arrow-left"></i>　返回購物</a>
            <a href="{{ route('shopping-cart.step02') }}" class="btn btn-primary">下一步</a>
        @else
            @if ($step == 2)
                <a href="{{ route('shopping-cart.step0'.$step-1) }}" class="btn px-5 fw-bolder btn-white border-primary border border-2 text-primary">上一步</a>
                <button class="btn btn-primary" id="next">下一步</button>
            @elseif($step == 3)
                <a href="{{ route('shopping-cart.step0'.$step-1) }}" class="btn px-5 fw-bolder btn-white border-primary border border-2 text-primary">上一步</a>
                <button class="btn btn-primary" id="next">前往結帳</button>
            @else
                <a href="{{ route('shopping-cart.step0'.$step-1) }}" class="btn px-5 fw-bolder btn-white border-primary border border-2 text-primary">上一步</a>
                <button class="btn btn-primary" id="next">送出訂單</button>
            @endif
        @endif
    </div>
</div>
