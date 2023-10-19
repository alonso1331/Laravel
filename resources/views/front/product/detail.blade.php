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

    .cart span{
        width: 40px;
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
                <p class="card-text text-danger fw-bolder fs-1 text-end">${{ $products->price }}</p>
                <p class="card-text fs-3 mt-4">{!! $products->descripte !!}</p>
                <div class="d-flex flex-row mt-5 cart pt-3">
                    <div class="cart-number d-flex flex-row align-items-center fs-5">數量
                        <div class="minus bg-secondary bg-opacity-25">-</div>
                        <span>1</span>
                        <div class="plus bg-secondary bg-opacity-25">+</div>
                    </div>
                    <a href="#" class="btn btn-primary">加入購物車</a>
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
</script>

@endsection

