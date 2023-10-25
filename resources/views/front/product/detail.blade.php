@extends('layouts.template')

@section('title', '產品資訊細項 Detail')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<style>
    .cart{
        border-top: 2px solid #333;
    }

    .cart .minus{
        margin-left: 10px;
    }

    .cart .minus, .cart span, .cart .plus{
        text-align: center;
        border: 1px solid #999;
    }

    .cart .minus, .cart .plus{
        width: 30px;
        cursor: pointer;
    }

    .cart input{
        width: 40px;
        height: 32px;
        text-align: center;
    }

    .cart .btn{
        margin-left: 30px;
        width: 140px;
    }

    .img{
        display: block;
        margin: auto;
        width: 600px;
        height: 400px;
        margin-bottom: 30px;
    }

    html,
    body {
      position: relative;
      height: 100%;
    }

    body {
      /* background: #eee; */
      font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
      font-size: 14px;
      color: #000;
      margin: 0;
      padding: 0;
    }

    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 400px;
      height: 300px;
      object-fit: fill;
    }
</style>
@endsection

@section('main')
<div class="container-xl">
    <div class="card my-5 border-0" style="max-width: 1280px;">
        <div class="row g-0">
            <div class="col-md-7 p-3">
                {{-- <img src="{{ Storage::url($products->image_url) }}" class="img-fluid rounded-start" alt="..."> --}}
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($products->productImages as $productImage)
                            <div class="swiper-slide">
                                <img src="{{ Storage::url($productImage->image_url) }}" class="img" alt="...">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card-body">
                    <h5 class="card-title fs-3 fw-bolder">{{ $products->name }}</h5>
                    <p class="card-text text-danger fw-bolder fs-1 text-end">${{ number_format($products->price) }}</p>
                    <p class="card-text fs-3 mt-4">{!! $products->descripte !!}</p>
                    <div class="d-flex flex-row mt-5 cart pt-3">
                        <div class="cart-number d-flex flex-row align-items-center fs-5">數量
                            <div class="minus bg-secondary bg-opacity-25">-</div>
                            <input type="text" min="1" value="1" readonly>
                            <div class="plus bg-secondary bg-opacity-25">+</div>
                        </div>
                        <button data-id={{ $products->id }} class="btn btn-primary add-cart">加入購物車</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($products->productImages as $productImage)
        <img src="{{ Storage::url($productImage->image_url) }}" class="img" alt="...">
    @endforeach
    {{-- <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @foreach ($productImages as $productImage)
                <div class="swiper-slide">
                    <img src="{{ Storage::url($productImage->image_url) }}" class="img" alt="...">
                </div>
            @endforeach
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div> --}}
</div>

@endsection

@section('js')
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        pagination: {
        el: ".swiper-pagination",
        type: "fraction",
        },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
        },
    });

    // 用js送購物車資訊
    const plus = document.querySelector('.plus');
    const minus = document.querySelector('.minus');
    const input = document.querySelector('input');
    const addCart = document.querySelector('.add-cart');

    plus.addEventListener('click',()=> {
        input.value = Number(input.value) + 1;
    });

    minus.addEventListener('click', ()=> {
        if(input.value > 1){
            input.value = Number(input.value) - 1;
        }else{
            input.value = 1;
        }
    });

    addCart.addEventListener('click', ()=> {
        // 產品ID
        let productId = addCart.getAttribute('data-id');

        // 產品數量
        let qty = input.value;

        let formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('id', productId);
        formData.append('qty', qty);

        // fetch
        let url = '{{ route('shopping-cart.add') }}';
        fetch(url, {
            method: 'post',
            body: formData
        }).then((response)=> {
            return response.text();
        }).then((data)=> {
            // console.log(data);
            if(data == 'success'){
                alert('加入成功');
            }
        });
    });


</script>
@endsection

