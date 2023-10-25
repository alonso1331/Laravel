@extends('layouts.template')

@section('title', '確認購物車')

@section('css')
<link rel="stylesheet" href="{{ asset('css/step01.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.css" />
@endsection

@section('main')
<div id="cart" class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body p-5">
                {{-- 購物車的header --}}
                @include('front.shopping-cart.shopping-cart-header',['step'=>1])

                {{-- 訂單明細 --}}
                <div class="mt-4 pt-4 cart-detail">
                    <h3 class="mb-4">訂單明細</h3>
                    @foreach ($items as $item)
                        <div class="cart-info d-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-item-center">
                                <div class="produc-info d-flex align-items-center">
                                    <div class="delete-btn btn-danger d-flex justify-content-center align-items-center " data-id="{{ $item->id }}">X</div>
                                </div>
                                <img src="{{ Storage::url($item->attributes->image_url) }}" alt="" class="me-3" width="200px">
                                <div class="produc-info d-flex align-items-center">
                                    <p>{{ $item->name }}</p>
                                </div>
                            </div>
                            <div class="order-item-price item" data-id="{{ $item->id }}">
                                <button type="button" class="minus border-0">-</button>
                                <input type="text" class="qty" min="1" max="999" value="{{ $item->quantity }}" readonly>
                                <button type="button" class="plus border-0">+</button>
                                <span class="ms-2 price" data-single="{{ $item->price }}">${{ number_format($item->price*$item->quantity) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- 購物車的footer --}}
                @include('front.shopping-cart.shopping-cart-footer', ['step'=>1])
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const minusBtns = document.querySelectorAll('.minus');
    const plusBtns = document.querySelectorAll('.plus');
    const deleteBtns = document.querySelectorAll('.delete-btn');


    // function qtyCalc(element, compute){
    //     const itemElement = element.parentElement;
    //     const qtyElement = itemElement.querySelector('.qty');
    //     let qty = Number(qtyElement.value) + compute;
    //     let productId = itemElement.getAttribute('data-id');
    //     qty = qty < 1 ? 1 : qty;

    //     let formData = new FormData();
    //     formData.append('_token', '{{ csrf_token() }}');
    //     formData.append('id', productId);
    //     formData.append('qty', qty);

    //     let url= '{{ route('shopping-cart.update') }}';
    //     fetch(url,{
    //         'method': 'post',
    //         'body': formData
    //     }).then(function(response){
    //         return response.json();
    //     }).then(function(item){
    //         if(item.quantity){
    //             qtyElement.value = item.quantity;
    //             singleItemTotalCale(element);
    //         }
    //     });
    // }

    // function singleItemTotalCale(element){
    //     const priceElement = element.parentElement.querySelector('.price');
    //     const qtyElement = element.parentElement.querySelector('.qty');
    //     let price = priceElement.getAttribute('data-single');
    //     let qty =  qtyElement.value;
    //     let total = price * qty;
    //     priceElement.textContent = `\$${total.toLocaleString()}`;
    // }

    // minusBtns.forEach(function(minusBtn) {
    //     minusBtn.addEventListener('click', function(){
    //         qtyCalc(this, -1);
    //     })
    // });

    // plusBtns.forEach(function(plusBtn){
    //     plusBtn.addEventListener('click',function(){
    //         qtyCalc(this, 1);
    //     })
    // });

    // 數量計算
    function qtyCalc(element, compute) {
        const itemElement = element.parentElement;
        const qtyElement = itemElement.querySelector('.qty');

        // let answer = 0;
        // if(compute == 'minus'){
        //     qty = Number(qtyElement.value) - 1;

        // }else{
        //     qty = Number(qtyElement.value) + 1;
        // }

        // 上述if判斷式可精簡為，但在click事件內要設定相對應的值
        let qty = Number(qtyElement.value) + compute;
        qty = qty < 1 ? 1 : qty;

        // 更新資料庫的數量
        let productId = itemElement.getAttribute('data-id');

        let formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', productId);
        formData.append('qty', qty);

        let url = '{{ route('shopping-cart.update') }}';
        fetch(url, {
            'method': 'post',
            'body': formData
        }).then(function(response){
            // 資料回傳是陣列，要用json()，因為這個地方原先打成text()，資料回傳沒接到，造成前端的數字沒有及時更新
            return response.json();
        }).then(function(item) {
            if(item.quantity){
                qtyElement.value = item.quantity;
                // 因為非同步，會導致數量更新，但是金額沒更新，所以把計算放在這裡處裡
                priceCalc(element);
                totalPriceCalc();
            }
        });

        // qtyElement.value = qty < 1 ? 1 : qty;
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

    //訂單總額
    function totalPriceCalc(){
        const itemElements = document.querySelectorAll('.item');
        const orderQtyElement = document.querySelector('#qty');
        const orderSubtotalElement = document.querySelector('#subtotal');
        const orderFeeElement = document.querySelector('#fee');
        const orderTotalElement = document.querySelector('#total');
        // 總數
        let totalQty = 0;
        // 商品單件小計
        let subtotal = 0;
        //運費，此頁還不會生成運費
        let fee = 60;
        // 所有商品的總金額
        let total = 0;
        itemElements.forEach(function (itemElement) {
            const qtyElement = itemElement.querySelector('.qty');
            const priceElement = itemElement.querySelector('.price');
            totalQty += Number(qtyElement.value);
            subtotal += qtyElement.value * priceElement.getAttribute('data-single');
        });
        total = fee + subtotal;

        orderQtyElement.textContent = totalQty;
        orderSubtotalElement.textContent = `\$${subtotal.toLocaleString()}`;
        orderTotalElement.textContent = `\$${total.toLocaleString()}`;
    }

    minusBtns.forEach(function(minusBtn) {
        minusBtn.addEventListener('click', function(){
            // if判斷是會用到
            //qtyCalc(this, 'minus');
            qtyCalc(this, -1);
            // 因為非同步處理的問題，要放在更新數量的函式處理
            // priceCalc(this);
        });
    });

    plusBtns.forEach(function(plusBtn){
        plusBtn.addEventListener('click', function(){
            // if判斷是會用到
            // qtyCalc(this, 'plus');
            qtyCalc(this, 1);
            // 因為非同步處理的問題，要放在更新數量的函式處理
            // priceCalc(this);
        });
    });

    // 刪除功能
    deleteBtns.forEach((deleteBtn) => {
        deleteBtn.addEventListener('click', ()=>{
            Swal.fire({
                title: '是否確定刪除商品?',
                // text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '是',
                cancelButtonText: '否',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        '刪除成功',
                        '您的商品已刪除'
                    )

                    let productId = deleteBtn.getAttribute('data-id');
                    let formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('id', productId);

                    let url = '{{ route('shopping-cart.destroy')}}';
                    fetch(url,{
                        method: 'post',
                        body: formData
                    }).then((response)=>{
                        return response.text();
                    }).then((data)=>{
                        if(data == 'success'){
                            const cartInfo = document.querySelector('.cart-info');
                            // deleteBtn.parentElement.parentElement.parentElement.remove();
                            cartInfo.remove();
                            totalPriceCalc();
                        }
                    });
                }
            })
        });
    });

    totalPriceCalc();

</script>

@endsection
