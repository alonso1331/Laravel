@extends('layouts.template')

@section('title', '產品資訊 NEWS')

@section('css')

<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection

@section('main')
    <div class="container-xl">
        <h1 class="text-center m-5">產品資訊</h1>
        <div class="sort d-flex flex-row">
            <a href="{{ route('products.list', 'category_id=0') }}" class="btn btn-success me-3">所有</a>
            @foreach ($productCategories as $productCategory)
                <a href="{{ route('products.list', 'category_id='.$productCategory->id) }}" class="btn btn-success me-3">{{ $productCategory->name }}</a>
            @endforeach
        </div>
        <hr>
        <div class="col-md-12 d-flex flex-row flex-wrap mb-3">
            @foreach ($products as $product)
            <div class="card m-3" style="width: 18rem;" data-category="{{ $product->productCategories->name }}">
                <img src="{{ Storage::url($product->image_url) }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <a href="{{ route('products.detail', $product->id) }}"><h5 class="card-title fw-bolder text-dark">{{ $product->name }}</h5></a>
                    <p class="card-text">${{ $product->price }}</p>
                    <a href="#" class="btn btn-primary">加入購物車</a>
                </div>
              </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
<script>
    // 自己嘗試用JS寫出篩選功能，先註解，因為重點是用後端篩選功能
    // const tabs = document.querySelectorAll('.sort .btn');
    // const cards = document.querySelectorAll('.card');
    // tabs.forEach(tab => {d
    //     tab.addEventListener('click', ()=> {
    //         // console.log(tab == tabs[0]);
    //         if (tab == tabs[0]){
    //             cards.forEach(card => {
    //                 card.style.display = 'block';
    //             });
    //         }else{
    //             // 將tab的分類設為參數，不能用e.textContent，會抓不到值
    //             let category = tab.textContent;

    //             // 當點擊tab時，卡片都先隱藏
    //             cards.forEach(card => {
    //                 card.style.display = 'none';
    //             });

    //             // 指定data-category 符合 tab 的 category的類別，將其顯示出來
    //             const targetCards = document.querySelectorAll(`[data-category="${category}"]`);
    //             targetCards.forEach(targetCard => {
    //                 targetCard.style.display = 'block';
    //             });
    //         }
    //     })
    // });
</script>

@endsection
